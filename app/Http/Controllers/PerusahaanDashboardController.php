<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lowongan;
use App\Models\Lamaran;

class PerusahaanDashboardController extends Controller {
    public function index() {
        abort_if ( !auth()->user()?->isPerusahaan(), 403 );

        $perusahaan = auth()->user()->perusahaan;

        $stat = [
            'total_lowongan'  => Lowongan::where( 'perusahaan_id', $perusahaan->id )->count(),
            'published'       => Lowongan::where( 'perusahaan_id', $perusahaan->id )->where( 'status', 'published' )->count(),
            'pending'         => Lowongan::where( 'perusahaan_id', $perusahaan->id )->where( 'status', 'pending' )->count(),
            'total_lamaran'   => Lamaran::whereHas( 'lowongan', fn( $q )=>$q->where( 'perusahaan_id', $perusahaan->id ) )->count(),
        ];

        $lowonganSaya = Lowongan::where( 'perusahaan_id', $perusahaan->id )
        ->latest()->limit( 8 )->get();

        $lamaranTerbaru = Lamaran::with( [ 'lowongan', 'pelamar' ] )
        ->whereHas( 'lowongan', fn( $q )=>$q->where( 'perusahaan_id', $perusahaan->id ) )
        ->latest()->limit( 10 )->get();

        return view( 'perusahaan.dashboard', compact( 'stat', 'lowonganSaya', 'lamaranTerbaru', 'perusahaan' ) );
    }
}