<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\Request;

class CompanyLamaranController extends Controller {
    private function ensureOwner( Lowongan $lowongan ) {
        abort_if ( $lowongan->perusahaan_id !== auth()->user()->perusahaan->id, 403, 'Bukan milik Anda.' );
    }

    public function index( Request $r, Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );

        $items = Lamaran::with( 'pelamar' )
        ->where( 'lowongan_id', $lowongan->id )
        ->when( $r->status, fn( $q )=>$q->where( 'status', $r->status ) )
        ->latest()->paginate( 20 )->withQueryString();

        return view( 'perusahaan.lamaran.index', compact( 'lowongan', 'items' ) );
    }

    public function updateStatus( Request $r, Lamaran $lamaran ) {
        $this->ensureOwner( $lamaran->lowongan );
        $data = $r->validate( [ 'status'=>'required|in:diproses,diterima,ditolak' ] );
        $lamaran->update( $data );

        // ( opsional ) kirim notifikasi internal ke pelamar
        \App\Models\Notification::create( [
            'user_id' => $lamaran->user_id,
            'type'    => 'status_lamaran',
            'message' => "Status lamaran: {$lamaran->status}",
        ] );

        return back()->with( 'ok', 'Status lamaran diperbarui.' );
    }
}
