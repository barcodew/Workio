<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Pelamar;
use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class RegisterController extends Controller {
    public function choice() {
        return view( 'auth.register_choice' );
    }

    public function showPelamar() {
        return view( 'auth.register_pelamar' );
    }

    public function showPerusahaan() {
        return view( 'auth.register_perusahaan' );
    }

    public function store( Request $r ) {
        // role harus pelamar/perusahaan
        $role = $r->input( 'role' );
        abort_unless( in_array( $role, [ 'pelamar', 'perusahaan' ] ), 400, 'Role tidak valid' );

        // validasi dasar
        $rules = [
            'name'      => [ 'required', 'string', 'max:100' ],
            'email'     => [ 'required', 'string', 'email', 'max:150', 'unique:users,email' ],
            'password'  => [ 'required', 'confirmed', 'min:8' ],
            'role'      => [ 'required', Rule::in( [ 'pelamar', 'perusahaan' ] ) ],
        ];

        // jika perusahaan, wajib nama_perusahaan
        if ( $role === 'perusahaan' ) {
            $rules[ 'nama_perusahaan' ] = [ 'required', 'string', 'max:150' ];
        }

        $data = $r->validate( $rules );

        // buat user
        $user = User::create( [
            'name'     => $data[ 'name' ],
            'email'    => $data[ 'email' ],
            'password' => Hash::make( $data[ 'password' ] ),
            'role'     => $role,
        ] );

        // buat profil turunan
        if ( $role === 'pelamar' ) {
            Pelamar::create( [
                'user_id' => $user->id,
                // tambahkan field default lain bila ada ( phone, alamat, dll )
            ] );
        } else {
            Perusahaan::create( [
                'user_id'          => $user->id,
                'nama_perusahaan'  => $data[ 'nama_perusahaan' ],
                // field lain opsional: alamat, website, dll
            ] );
        }

        // login & redirect
        Auth::login( $user );
        $r->session()->regenerate();

        return redirect()->route(
            $role === 'perusahaan' ? 'perusahaan.dashboard' : 'pelamar.dashboard'
        )->with( 'success', 'Akun berhasil dibuat.' );
    }
}
