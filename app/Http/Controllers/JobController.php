<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lowongan;

use App\Models\Perusahaan;
use App\Models\Lamaran;

class JobController extends Controller {
    public function index( Request $r ) {
        $lowongans = Lowongan::with( 'perusahaan' )->filter( $r->only( 'q', 'lokasi', 'tipe' ) )->paginate( 12 );
        return view( 'jobs.index', compact( 'lowongans' ) );
    }

    public function create() {
        abort_if ( !auth()->user()->isPerusahaan(), 403 );
        return view( 'jobs.create' );
    }

    public function store( Request $r ) {
        abort_if ( !auth()->user()->isPerusahaan(), 403 );

        $data = $r->validate( [
            'judul'=>'required|max:200',
            'deskripsi'=>'required',
            'kualifikasi'=>'nullable',
            'lokasi'=>'nullable|max:150',
            'tipe_pekerjaan'=>'nullable|in:Full-time,Part-time,Internship,Contract',
            'deadline'=>'nullable|date',
        ] );

        Lowongan::create( [
            'perusahaan_id'=>auth()->user()->perusahaan->id,
            ...$data,
            'status'=>'pending',
        ] );

        return redirect()->route( 'perusahaan.lowongan' )->with( 'ok', 'Lowongan tersimpan & menunggu validasi admin.' );
    }

    public function mine() {
        abort_if ( !auth()->user()->isPerusahaan(), 403 );

        $perusahaanId = auth()->user()->perusahaan->id;
        $lowongans = \App\Models\Lowongan::where( 'perusahaan_id', $perusahaanId )
        ->latest()->paginate( 12 );

        return view( 'jobs.mine', compact( 'lowongans' ) );
    }

    public function show( \App\Models\Lowongan $lowongan ) {
        // Tampilkan hanya published, kecuali owner perusahaan/admin
        $u = auth()->user();
        if ( $lowongan->status !== 'published' && !( $u?->isPerusahaan() || $u?->isAdmin() ) ) {
            abort( 404 );
        }

        $lowongan->load( 'perusahaan' );

        $alreadyApplied = false;
        $myLamaran = null;

        if ( $u && $u->isPelamar() ) {
            $myLamaran = Lamaran::where( 'lowongan_id', $lowongan->id )
            ->where( 'user_id', $u->id )
            ->latest()->first();
            $alreadyApplied = ( bool ) $myLamaran;
        }

        return view( 'jobs.show', compact( 'lowongan', 'alreadyApplied', 'myLamaran' ) );
    }

}
