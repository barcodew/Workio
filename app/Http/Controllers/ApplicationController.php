<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lamaran;
use Illuminate\Database\QueryException;
use App\Models\Notification;

class ApplicationController extends Controller {

    public function store( Request $r, \App\Models\Lowongan $lowongan ) {
        abort_if ( !auth()->user()->isPelamar(), 403 );

        // Validasi file opsional
        $data = $r->validate( [
            'file_cv'       => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'surat_lamaran' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ] );

        // Ambil CV dari upload atau dari profil
        $cvPath = null;
        if ( $r->file( 'file_cv' ) ) {
            $cvPath = $r->file( 'file_cv' )->store( 'cv', 'public' );
        } else {
            $cvPath = auth()->user()->pelamar->cv_path;
            // bisa null
        }

        $surPath = $r->file( 'surat_lamaran' ) ? $r->file( 'surat_lamaran' )->store( 'surat', 'public' ) : null;

        // Cegah apply 2x ke lowongan yang sama
        $exists = Lamaran::where( 'lowongan_id', $lowongan->id )->where( 'user_id', auth()->id() )->exists();
        if ( $exists ) {
            return back()->with( 'err', 'Kamu sudah melamar lowongan ini.' );
        }

        try {
            Lamaran::create( [
                'lowongan_id'   => $lowongan->id,
                'user_id'       => auth()->id(),
                'tanggal_lamar' => now(),
                'status'        => 'dikirim',
                'file_cv'       => $cvPath,
                'surat_lamaran' => $surPath,
            ] );
        } catch ( QueryException $e ) {
            // fallback kalau unique constraint menolak duplikat
            return back()->with( 'err', 'Kamu sudah melamar lowongan ini.' );
        }

        // Notifikasi internal sederhana
        Notification::create( [
            'user_id' => $lowongan->perusahaan->user_id,
            'type'    => 'lamaran_baru',
            'message' => "Lamaran baru untuk {$lowongan->judul}",
        ] );

        return back()->with( 'ok', 'Lamaran terkirim. Semoga berhasil!' );
    }

    public function review( Request $r, Lamaran $lamaran ) {
        abort_if ( !auth()->user()->isPerusahaan(), 403 );
        $data = $r->validate( [ 'status'=>'required|in:diproses,diterima,ditolak' ] );
        $lamaran->update( $data );

        Notification::create( [
            'user_id'=>$lamaran->user_id,
            'type'=>'status_lamaran',
            'message'=>"Status lamaran kamu: {$lamaran->status}",
        ] );

        return back()->with( 'ok', 'Status lamaran diperbarui.' );
    }
}

