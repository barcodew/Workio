<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;  
use Illuminate\Support\Facades\Hash;  
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
            'email'    => 'required|email|max:150|unique:users',
            'password' => 'required|min:8|confirmed',
            'role'     => 'required|in:pelamar,perusahaan',
        ] );

        $user = User::create( [
            'name'  => $data[ 'name' ],
            'email' => $data[ 'email' ],
            'password' => Hash::make( $data[ 'password' ] ),
            'role'  => $data[ 'role' ],
        ] );

        if ( $user->isPelamar() )    Pelamar::create( [ 'user_id'=>$user->id ] );
        if ( $user->isPerusahaan() ) Perusahaan::create( [ 'user_id'=>$user->id, 'nama_perusahaan'=>$user->name ] );

        Auth::login( $user );
        $r->session()->regenerate();

        return redirect()->route( $user->isPerusahaan() ? 'perusahaan.dashboard' : 'pelamar.dashboard' );
    }

    public function login( Request $r ) {
        $cred = $r->validate( [
            'email'    => 'required|email',
            'password' => 'required',
            'remember' => 'nullable|boolean'
        ] );

        if ( Auth::attempt( [ 'email'=>$cred[ 'email' ], 'password'=>$cred[ 'password' ] ], $cred[ 'remember' ] ?? false ) ) {
            $r->session()->regenerate();
            $user = auth()->user();
            return redirect()->intended(
                $user->isAdmin() ? route( 'admin.dashboard' ) :
                ( $user->isPerusahaan() ? route( 'perusahaan.dashboard' ) : route( 'pelamar.dashboard' ) )
            );
        }

        return back()->withErrors( [ 'email'=>'Kredensial tidak valid.' ] )->onlyInput( 'email' );
    }

    public function logout( Request $r ) {
        Auth::logout();
        $r->session()->invalidate();
        $r->session()->regenerateToken();
        return redirect()->route( 'login' )->with( 'ok', 'Berhasil keluar.' );
    }
}
