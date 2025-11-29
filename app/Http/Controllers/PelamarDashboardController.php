<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lamaran;
use App\Models\Lowongan;

class PelamarDashboardController extends Controller {
    public function index() {
        abort_if ( !auth()->user()?->isPelamar(), 403 );

        $user = auth()->user();
        $stat = [
            'total_lamaran' => Lamaran::where( 'user_id', $user->id )->count(),
            'diproses'      => Lamaran::where( 'user_id', $user->id )->where( 'status', 'diproses' )->count(),
            'diterima'      => Lamaran::where( 'user_id', $user->id )->where( 'status', 'diterima' )->count(),
            'ditolak'       => Lamaran::where( 'user_id', $user->id )->where( 'status', 'ditolak' )->count(),
        ];

        $lamaranTerakhir = Lamaran::with( 'lowongan.perusahaan' )
        ->where( 'user_id', $user->id )
        ->latest()->limit( 10 )->get();

        $rekomendasi = Lowongan::with( 'perusahaan' )
        ->where( 'status', 'published' )
        ->latest()->limit( 6 )->get();

        $pelamar = $user->pelamar;

        return view( 'pelamar.dashboard', compact( 'stat', 'lamaranTerakhir', 'rekomendasi', 'pelamar' ) );
    }


    
}