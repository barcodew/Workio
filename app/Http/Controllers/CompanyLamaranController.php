<?php

namespace App\Http\Controllers;

use App\Models\Lamaran;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use App\Notifications\LamaranStatusUpdated;

class CompanyLamaranController extends Controller {
    private function ensureOwner( Lowongan $lowongan ) {
        abort_if (
            ( int ) $lowongan->perusahaan_id !== ( int ) auth()->user()->perusahaan->id,
            403,
            'Bukan punya Anda.'
        );
    }

    public function index( Request $r, Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );

        $items = Lamaran::with( 'pelamar' )
        ->where( 'lowongan_id', $lowongan->id )
        ->when( $r->status, fn ( $q ) => $q->where( 'status', $r->status ) )
        ->latest()
        ->paginate( 20 )
        ->withQueryString();

        return view( 'perusahaan.lamaran.index', compact( 'lowongan', 'items' ) );
    }

    public function updateStatus( Request $r, Lamaran $lamaran ) {
        $this->ensureOwner( $lamaran->lowongan );

        $data = $r->validate( [
            'status' => 'required|in:diproses,diterima,ditolak',
        ] );

        $lamaran->update( $data );

        // internal notification ( versi lama ) – boleh dipertahankan
        \App\Models\Notification::create( [
            'user_id' => $lamaran->user_id,
            'type'    => 'status_lamaran',
            'message' => "Status lamaran: {$lamaran->status}",
        ] );

        // EMAIL notification
        $lamaran->user->notify( new LamaranStatusUpdated( $lamaran ) );

        return back()->with( 'ok', 'Status lamaran diperbarui.' );
    }
}
