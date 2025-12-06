<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lowongan;
use App\Models\Lamaran;
use App\Models\Perusahaan;
use App\Models\Pelamar;
use App\Models\AdminActivityLog;
// <-- tambahkan ini

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

        // === aktivitas terbaru ( log ) ===
        $aktivitasTerbaru = AdminActivityLog::with( [ 'user', 'lowongan', 'perusahaan', 'pelamar' ] )
        ->latest()
        ->limit( 8 )
        ->get();

        return view( 'admin.dashboard', compact(
            'stat',
            'lowonganBaru',
            'lamaranBaru',
            'aktivitasTerbaru'   // <-- jangan lupa ini
        ) );
    }

    public function LogsView( Request $request ) {
        abort_if ( !auth()->user()?->isAdmin(), 403 );

        $query = AdminActivityLog::with( [ 'user', 'lowongan', 'perusahaan', 'pelamar.user' ] )
        ->latest();

        // FILTER
        if ( $request->filled( 'lowongan_id' ) ) {
            $query->where( 'lowongan_id', $request->lowongan_id );
        }

        if ( $request->filled( 'perusahaan_id' ) ) {
            $query->where( 'perusahaan_id', $request->perusahaan_id );
        }

        if ( $request->filled( 'pelamar_id' ) ) {
            $query->where( 'pelamar_id', $request->pelamar_id );
        }

        if ( $request->filled( 'action' ) ) {
            $query->where( 'action', $request->action );
        }

        $aktivitas = $query->paginate( 20 )->withQueryString();

        // dropdown filter
        $lowongans   = Lowongan::orderBy( 'judul' )->get( [ 'id', 'judul' ] );
        $perusahaans = Perusahaan::orderBy( 'nama_perusahaan' )->get( [ 'id', 'nama_perusahaan' ] );

        // ⬇️ DI SINI YANG TADI ERROR
        // ambil pelamar + relasi user ( nama di users.name )
        $pelamars    = Pelamar::with( 'user' )->get();
        // tanpa select( 'name' ) lagi

        return view( 'admin.aktivitas.index', compact(
            'aktivitas',
            'lowongans',
            'perusahaans',
            'pelamars'
        ) );
    }
}
