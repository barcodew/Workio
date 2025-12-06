<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

use App\Models\User;
use App\Models\Pelamar;
use App\Models\Perusahaan;

class AuthController extends Controller {
    public function showLogin() {
        return view( 'auth.login' );
    }

    // public function showRegister()
    // {
    //     return view( 'auth.register' );
    // }

    public function choice() {
        return view( 'auth.register_choice' );
    }

    public function showPelamar() {
        return view( 'auth.register_pelamar' );
    }

    public function showPerusahaan() {
        return view( 'auth.register_perusahaan' );
    }

    /**
    * REGISTER PELAMAR & PERUSAHAAN
    */

    public function register( Request $r ) {
        // role harus pelamar / perusahaan
        $role = $r->input( 'role' );
        if ( !in_array( $role, [ 'pelamar', 'perusahaan' ], true ) ) {
            // kalau ada yang iseng ubah role di form
            return back()
            ->withInput()
            ->with( 'swal', [
                'icon'  => 'error',
                'title' => 'Role tidak valid',
                'text'  => 'Silakan pilih jenis akun yang sesuai.',
            ] );
        }

        // RULE VALIDASI DASAR
        $rules = [
            'name'     => [ 'required', 'string', 'max:100' ],
            'email'    => [ 'required', 'string', 'email', 'max:150', 'unique:users,email' ],
            'password' => [ 'required', 'confirmed', 'min:8' ],
            'role'     => [ 'required', Rule::in( [ 'pelamar', 'perusahaan' ] ) ],
        ];

        // jika perusahaan, wajib nama_perusahaan
        if ( $role === 'perusahaan' ) {
            $rules[ 'nama_perusahaan' ] = [ 'required', 'string', 'max:150' ];
        }

        // PESAN ERROR KUSTOM ( opsional, biar lebih manusiawi )
        $messages = [
            'name.required'  => 'Nama wajib diisi.',
            'name.max'       => 'Nama maksimal 100 karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
            'email.unique'   => 'Email ini sudah terdaftar.',
            'password.required'  => 'Password wajib diisi.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.min'       => 'Password minimal 8 karakter.',
            'role.required'      => 'Role wajib dipilih.',
            'role.in'            => 'Role tidak valid.',
            'nama_perusahaan.required' => 'Nama perusahaan wajib diisi.',
        ];

        $data = $r->validate( $rules, $messages );

        // BUAT USER
        $user = User::create( [
            'name'     => $data[ 'name' ],
            'email'    => $data[ 'email' ],
            'password' => Hash::make( $data[ 'password' ] ),
            'role'     => $role,
        ] );

        // BUAT PROFIL TURUNAN
        if ( $role === 'pelamar' ) {
            Pelamar::create( [
                'user_id' => $user->id,
                // kalau mau, bisa kasih default lain di sini
            ] );
        } else {
            Perusahaan::create( [
                'user_id'         => $user->id,
                'nama_perusahaan' => $data[ 'nama_perusahaan' ],
            ] );
        }

        // TRIGGER EVENT REGISTERED → kirim email verifikasi ( kalau mail sudah diset )
        event( new Registered( $user ) );

        // LOGIN & REGENERATE SESSION
        Auth::login( $user );
        $r->session()->regenerate();

        // Redirect ke halaman verifikasi email ( supaya konsisten dengan flow sebelumnya )
        return redirect()
        ->route( 'verification.notice' )
        ->with( 'swal', [
            'icon'  => 'success',
            'title' => 'Akun berhasil dibuat',
            'text'  => 'Cek email kamu untuk verifikasi sebelum menggunakan Workio.',
        ] );
    }

    /**
    * LOGIN
    */

    public function login( Request $r ) {
        $cred = $r->validate(
            [
                'email'    => 'required|email',
                'password' => 'required',
                'remember' => 'nullable',
            ],
            [
                'email.required'    => 'Alamat email wajib diisi.',
                'email.email'       => 'Format alamat email tidak valid.',
                'password.required' => 'Password wajib diisi.',
            ]
        );

        $remember = $r->has( 'remember' );

        if ( Auth::attempt(
            [ 'email' => $cred[ 'email' ], 'password' => $cred[ 'password' ] ],
            $remember
        ) ) {
            $r->session()->regenerate();
            $user = auth()->user();

            // SIMPAN EMAIL ke cookie kalau remember dicentang
            if ( $remember ) {
                Cookie::queue( 'remember_email', $cred[ 'email' ], 60 * 24 * 365 );
            } else {
                Cookie::queue( Cookie::forget( 'remember_email' ) );
            }

            if ( !$user->hasVerifiedEmail() ) {
                return redirect()
                ->route( 'verification.notice' )
                ->with( 'swal', [
                    'icon'  => 'warning',
                    'title' => 'Verifikasi email dulu',
                    'text'  => 'Kami sudah kirimkan link verifikasi ke email kamu.',
                ] );
            }

            // redirect sesuai role
            $url = $user->isAdmin()
            ? route( 'admin.dashboard' )
            : ( $user->isPerusahaan()
            ? route( 'perusahaan.dashboard' )
            : route( 'pelamar.dashboard' ) );

            return redirect()->intended( $url )->with( 'swal', [
                'icon'  => 'success',
                'title' => 'Selamat datang, ' . $user->name,
                'text'  => 'Kamu berhasil login.',
            ] );
        }

        // login gagal
        return back()
        ->withErrors( [ 'email' => 'Email atau password tidak cocok.' ] )
        ->withInput( $r->only( 'email' ) )
        ->with( 'swal', [
            'icon'  => 'error',
            'title' => 'Login gagal',
            'text'  => 'Email atau password yang kamu masukkan tidak cocok.',
        ] );
    }

    /**
    * LOGOUT
    */

    public function logout( Request $r ) {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect()
        ->route( 'login' )
        ->with( 'swal', [
            'icon'  => 'success',
            'title' => 'Berhasil keluar',
            'text'  => 'Sampai jumpa lagi di Workio.',
        ] );
    }

    /* ===  ===  ===  ===  ===  ===  ===
    * LUPA PASSWORD
    * ===  ===  ===  ===  ===  ===  === */

    public function showForgotPassword() {
        return view( 'auth.forgot-password' );
    }

    public function sendResetLinkEmail( Request $request ) {
        $request->validate( [
            'email' => 'required|email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email'    => 'Format email tidak valid.',
        ] );

        $status = Password::sendResetLink(
            $request->only( 'email' )
        );

        if ( $status === Password::RESET_LINK_SENT ) {
            return back()
            ->with( 'status', __( $status ) )
            ->with( 'swal', [
                'icon'  => 'success',
                'title' => 'Link reset dikirim',
                'text'  => 'Cek email kamu untuk link reset password.',
            ] );
        }

        return back()
        ->withErrors( [ 'email' => __( $status ) ] )
        ->with( 'swal', [
            'icon'  => 'error',
            'title' => 'Gagal mengirim link',
            'text'  => 'Pastikan email sudah terdaftar di Workio.',
        ] );
    }

    public function showResetForm( string $token, Request $request ) {
        return view( 'auth.reset-password', [
            'token' => $token,
            'email' => $request->query( 'email' ),
        ] );
    }

    public function resetPassword( Request $request ) {
        $request->validate(
            [
                'token'    => 'required',
                'email'    => 'required|email',
                'password' => 'required|min:8|confirmed',
            ],
            [
                'email.required'    => 'Email wajib diisi.',
                'email.email'       => 'Format email tidak valid.',
                'password.required' => 'Password wajib diisi.',
                'password.min'      => 'Password minimal 8 karakter.',
                'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            ]
        );

        $status = Password::reset(
            $request->only( 'email', 'password', 'password_confirmation', 'token' ),

            function ( User $user, string $password ) {
                $user->forceFill( [
                    'password'       => Hash::make( $password ),
                    'remember_token' => Str::random( 60 ),
                ] )->save();

                event( new PasswordReset( $user ) );
            }
        );

        if ( $status === Password::PASSWORD_RESET ) {
            return redirect()
            ->route( 'login' )
            ->with( 'swal', [
                'icon'  => 'success',
                'title' => 'Password berhasil direset',
                'text'  => 'Silakan login dengan password baru.',
            ] );
        }

        return back()
        ->withErrors( [ 'email' => [ __( $status ) ] ] )
        ->with( 'swal', [
            'icon'  => 'error',
            'title' => 'Reset password gagal',
            'text'  => 'Token tidak valid atau sudah kadaluarsa.',
        ] );
    }
}
