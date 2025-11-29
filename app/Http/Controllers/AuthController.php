<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Registered;

// Tambahan:
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

    public function showRegister() {
        return view( 'auth.register' );
    }

    public function register( Request $r ) {
        $data = $r->validate( [
            'name'     => 'required|string|max:100',
            'email'    => 'required|email|max:150|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role'     => [ 'required', Rule::in( [ 'pelamar', 'perusahaan' ] ) ],
        ] );

        $user = User::create( [
            'name'     => $data[ 'name' ],
            'email'    => $data[ 'email' ],
            'password' => Hash::make( $data[ 'password' ] ),
            'role'     => $data[ 'role' ],
        ] );

        if ( $user->isPelamar() ) {
            Pelamar::create( [ 'user_id' => $user->id ] );
        } else {
            Perusahaan::create( [
                'user_id'         => $user->id,
                'nama_perusahaan' => $user->name,
            ] );
        }

        event( new Registered( $user ) );

        Auth::login( $user );
        $r->session()->regenerate();

        return redirect()
        ->route( 'verification.notice' )
        ->with( 'ok', 'Akun dibuat. Cek email kamu untuk verifikasi.' );
    }

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
                // 365 hari ( 60 menit * 24 jam * 365 )
                Cookie::queue( 'remember_email', $cred[ 'email' ], 60 * 24 * 365 );
            } else {
                Cookie::queue( Cookie::forget( 'remember_email' ) );
            }

            if ( ! $user->hasVerifiedEmail() ) {
                return redirect()->route( 'verification.notice' )
                ->with( 'ok', 'Silakan verifikasi email terlebih dahulu.' );
            }

            return redirect()->intended(
                $user->isAdmin()
                ? route( 'admin.dashboard' )
                : ( $user->isPerusahaan()
                ? route( 'perusahaan.dashboard' )
                : route( 'pelamar.dashboard' ) )
            );
        }

        return back()
        ->withErrors( [ 'email' => 'Email atau password tidak cocok.' ] )
        ->onlyInput( 'email' );
    }

    public function logout( Request $r ) {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();

        return redirect()->route( 'login' )->with( 'ok', 'Berhasil keluar.' );
    }

    /* ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  =
    *  LUPA PASSWORD
    * ===  ===  ===  ===  ===  ===  ===  ===  ===  ===  = */

    // 1 ) Tampilkan form 'Lupa password'

    public function showForgotPassword() {
        return view( 'auth.forgot-password' );
    }

    // 2 ) Kirim email link reset password

    public function sendResetLinkEmail( Request $request ) {
        $request->validate( [
            'email' => 'required|email',
        ] );

        $status = Password::sendResetLink(
            $request->only( 'email' )
        );

        return $status === Password::RESET_LINK_SENT
        ? back()->with( 'status', __( $status ) )
        : back()->withErrors( [ 'email' => __( $status ) ] );
    }

    // 3 ) Tampilkan form reset ( dari link email )

    public function showResetForm( string $token, Request $request ) {
        return view( 'auth.reset-password', [
            'token' => $token,
            'email' => $request->query( 'email' ),
        ] );
    }

    // 4 ) Simpan password baru

    public function resetPassword( Request $request ) {
        $request->validate( [
            'token'    => 'required',
            'email'    => 'required|email',
            'password' => 'required|min:8|confirmed',
        ] );

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

        return $status === Password::PASSWORD_RESET
        ? redirect()
        ->route( 'login' )
        ->with( 'ok', 'Password berhasil direset. Silakan login dengan password baru.' )
        : back()->withErrors( [ 'email' => [ __( $status ) ] ] );
    }

}
