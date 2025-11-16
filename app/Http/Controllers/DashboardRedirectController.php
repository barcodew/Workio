<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardRedirectController extends Controller {
    public function __invoke( Request $request ) {
        if ( !Auth::check() ) {
            return redirect()->route( 'login' );
        }

        $user = Auth::user();

        if ( method_exists( $user, 'isAdmin' ) && $user->isAdmin() ) {
            return redirect()->route( 'admin.dashboard' );
        }
        if ( method_exists( $user, 'isPerusahaan' ) && $user->isPerusahaan() ) {
            return redirect()->route( 'perusahaan.dashboard' );
        }
        if ( method_exists( $user, 'isPelamar' ) && $user->isPelamar() ) {
            return redirect()->route( 'pelamar.dashboard' );
        }
        return redirect()->route( 'pelamar.dashboard' );
    }
}
