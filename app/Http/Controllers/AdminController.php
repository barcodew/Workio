<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use App\Models\Lowongan;

use App\Models\Lamaran;

class AdminController extends Controller {
    public function dashboard() {
        abort_if ( !auth()->user()?->isAdmin(), 403 );

        $stat = [
            'pengguna'      => User::count(),
            'pelamar'       => User::role( 'pelamar' )->count(),
            'perusahaan'    => User::role( 'perusahaan' )->count(),
            'low_aktif'     => Lowongan::where( 'status', 'published' )->count(),
            'low_pending'   => Lowongan::where( 'status', 'pending' )->count(),
            'total_lamaran' => Lamaran::count(),
        ];

        $lowonganBaru  = Lowongan::with( 'perusahaan' )->latest()->limit( 8 )->get();
        $lamaranBaru   = Lamaran::with( [ 'lowongan.perusahaan', 'pelamar' ] )->latest()->limit( 8 )->get();

        return view( 'admin.dashboard', compact( 'stat', 'lowonganBaru', 'lamaranBaru' ) );
    }
}