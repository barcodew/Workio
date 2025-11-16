<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class CompanyLowonganController extends Controller {
    private function ensureOwner( Lowongan $lowongan ) {
        abort_if ( $lowongan->perusahaan_id !== auth()->user()->perusahaan->id, 403, 'Bukan milik Anda.' );
    }

    public function index( Request $r ) {
        $pid = auth()->user()->perusahaan->id;

        $items = \App\Models\Lowongan::with( 'perusahaan' )
        ->where( 'perusahaan_id', $pid )
        ->when( $r->q, fn( $q )=>$q->where( 'judul', 'like', "%{$r->q}%" ) )
        ->when( $r->status, fn( $q )=>$q->where( 'status', $r->status ) )
        ->withCount( [
            'lamarans',
            'lamarans as l_dikirim_count'  => fn( $q )=>$q->where( 'status', 'dikirim' ),
            'lamarans as l_diproses_count' => fn( $q )=>$q->where( 'status', 'diproses' ),
            'lamarans as l_diterima_count' => fn( $q )=>$q->where( 'status', 'diterima' ),
            'lamarans as l_ditolak_count'  => fn( $q )=>$q->where( 'status', 'ditolak' ),
        ] )
        ->latest()
        ->paginate( 12 )
        ->withQueryString();

        return view( 'perusahaan.lowongan.index', compact( 'items' ) );
    }

    public function create() {
        return view( 'perusahaan.lowongan.create' );
    }

    public function store( Request $r ) {
        $data = $r->validate( [
            'judul'=>'required|max:200',
            'deskripsi'=>'required',
            'kualifikasi'=>'nullable',
            'lokasi'=>'nullable|max:150',
            'tipe_pekerjaan'=>'nullable|in:Full-time,Part-time,Internship,Contract',
            'deadline'=>'nullable|date',
        ] );

        Lowongan::create( [
            'perusahaan_id' => auth()->user()->perusahaan->id,
            ...$data,
            'status' => 'pending', // menunggu admin publish
        ] );

        return redirect()->route( 'perusahaan.lowongan.index' )->with( 'ok', 'Lowongan dibuat (status: pending).' );
    }

    public function edit( Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );
        return view( 'perusahaan.lowongan.edit', compact( 'lowongan' ) );
    }

    public function update( Request $r, Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );
        $data = $r->validate( [
            'judul'=>'required|max:200',
            'deskripsi'=>'required',
            'kualifikasi'=>'nullable',
            'lokasi'=>'nullable|max:150',
            'tipe_pekerjaan'=>'nullable|in:Full-time,Part-time,Internship,Contract',
            'deadline'=>'nullable|date',
        ] );
        $lowongan->update( $data );
        return back()->with( 'ok', 'Perubahan disimpan.' );
    }

    public function toggleStatus( Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );
        if ( $lowongan->status === 'published' ) {
            $lowongan->update( [ 'status'=>'closed' ] );
        } elseif ( $lowongan->status === 'closed' ) {
            $lowongan->update( [ 'status'=>'published' ] );
        }
        return back()->with( 'ok', 'Status lowongan diperbarui.' );
    }

    public function destroy( Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );
        $lowongan->delete();
        return back()->with( 'ok', 'Lowongan dihapus.' );
    }
}
