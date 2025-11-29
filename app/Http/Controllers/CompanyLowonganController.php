<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewLowonganPosted;

class CompanyLowonganController extends Controller {
    /**
    * Pastikan lowongan ini memang milik perusahaan dari user yang login.
    */

    private function ensureOwner( Lowongan $lowongan ) {
        $user       = auth()->user();
        $perusahaan = $user->perusahaan;

        abort_if ( ! $perusahaan, 403, 'Akun Anda belum memiliki profil perusahaan.' );

        $pidLow  = ( int ) $lowongan->perusahaan_id;
        $pidUser = ( int ) $perusahaan->id;

        abort_if ( $pidLow !== $pidUser, 403, 'Bukan milik Anda.' );
    }

    /**
    * Daftar semua lowongan milik perusahaan ( published + closed ).
    */

    public function index( Request $r ) {
        $pid = auth()->user()->perusahaan->id;

        $items = Lowongan::with( 'perusahaan' )
        ->where( 'perusahaan_id', $pid )
        ->when( $r->q, fn ( $q ) => $q->where( 'judul', 'like', "%{$r->q}%" ) )
        ->when( $r->status, fn ( $q ) => $q->where( 'status', $r->status ) )
        // TIDAK pakai ->notExpired() di sini, supaya lowongan closed tetap terlihat
        ->withCount( [
            'lamarans',
            'lamarans as l_dikirim_count'  => fn ( $q ) => $q->where( 'status', 'dikirim' ),
            'lamarans as l_diproses_count' => fn ( $q ) => $q->where( 'status', 'diproses' ),
            'lamarans as l_diterima_count' => fn ( $q ) => $q->where( 'status', 'diterima' ),
            'lamarans as l_ditolak_count'  => fn ( $q ) => $q->where( 'status', 'ditolak' ),
        ] )
        ->latest()
        ->paginate( 12 )
        ->withQueryString();

        return view( 'perusahaan.lowongan.index', compact( 'items' ) );
    }

    /**
    * Form buat lowongan baru.
    */

    public function create() {
        return view( 'perusahaan.lowongan.create' );
    }

    /**
    * Simpan lowongan baru.
    */

    public function store( Request $r ) {
        // Semua field wajib diisi
        $data = $r->validate(
            [
                'judul'          => 'required|string|max:200',
                'deskripsi'      => 'required|string',
                'kualifikasi'    => 'required|string',
                'lokasi'         => 'required|string|max:150',
                'tipe_pekerjaan' => 'required|in:Full-time,Part-time,Internship,Contract',
                'deadline'       => 'required|date',
                'skills_text'    => 'required|string|max:255',
            ],
            [
                'required'          => 'Kolom :attribute wajib diisi.',
                'judul.max'         => 'Judul maksimal 200 karakter.',
                'lokasi.max'        => 'Lokasi maksimal 150 karakter.',
                'tipe_pekerjaan.in' => 'Tipe pekerjaan tidak valid.',
                'deadline.date'     => 'Format tanggal deadline tidak valid.',
            ]
        );

        // Ubah teks ke array keahlian ( uppercase, unik, tanpa spasi berlebih )
        $skillsArray = collect( explode( ',', $data[ 'skills_text' ] ) )
        ->map( fn ( $s ) => mb_strtoupper( trim( $s ) ) )
        ->filter()
        ->unique()
        ->values()
        ->all();

        $lowongan = Lowongan::create( [
            'perusahaan_id' => auth()->user()->perusahaan->id,
            'judul'         => $data[ 'judul' ],
            'deskripsi'     => $data[ 'deskripsi' ],
            'kualifikasi'   => $data[ 'kualifikasi' ],
            'lokasi'        => $data[ 'lokasi' ],
            'tipe_pekerjaan'=> $data[ 'tipe_pekerjaan' ],
            'deadline'      => $data[ 'deadline' ],
            'keahlian'      => $skillsArray,       // disimpan sebagai array ( JSON )
            'status'        => 'published',        // atau 'pending' sesuai kebutuhan
        ] );

        // Kirim notifikasi ke semua pelamar yang sudah verifikasi email
        $pelamarUsers = User::where( 'role', 'pelamar' )
        ->whereNotNull( 'email_verified_at' )
        ->get();

        Notification::send( $pelamarUsers, new NewLowonganPosted( $lowongan ) );

        return redirect()
        ->route( 'perusahaan.lowongan.index' )
        ->with( 'ok', 'Lowongan berhasil dibuat.' );
    }

    /**
    * Form edit lowongan.
    */

    public function edit( Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );

        return view( 'perusahaan.lowongan.edit', [
            'lowongan' => $lowongan,
            'model'    => $lowongan,
        ] );
    }

    /**
    * Update lowongan.
    */

    public function update( Request $r, Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );

        $data = $r->validate(
            [
                'judul'          => 'required|string|max:200',
                'deskripsi'      => 'required|string',
                'kualifikasi'    => 'required|string',
                'lokasi'         => 'required|string|max:150',
                'tipe_pekerjaan' => 'required|in:Full-time,Part-time,Internship,Contract',
                'deadline'       => 'required|date',
                'skills_text'    => 'required|string|max:255',
            ],
            [
                'required'          => 'Kolom :attribute wajib diisi.',
                'judul.max'         => 'Judul maksimal 200 karakter.',
                'lokasi.max'        => 'Lokasi maksimal 150 karakter.',
                'tipe_pekerjaan.in' => 'Tipe pekerjaan tidak valid.',
                'deadline.date'     => 'Format tanggal deadline tidak valid.',
            ]
        );

        $skillsArray = collect( explode( ',', $data[ 'skills_text' ] ) )
        ->map( fn ( $s ) => mb_strtoupper( trim( $s ) ) )
        ->filter()
        ->unique()
        ->values()
        ->all();

        $lowongan->update( [
            'judul'          => $data[ 'judul' ],
            'deskripsi'      => $data[ 'deskripsi' ],
            'kualifikasi'    => $data[ 'kualifikasi' ],
            'lokasi'         => $data[ 'lokasi' ],
            'tipe_pekerjaan' => $data[ 'tipe_pekerjaan' ],
            'deadline'       => $data[ 'deadline' ],
            'keahlian'       => $skillsArray,
        ] );

        return back()->with( 'ok', 'Perubahan disimpan.' );
    }

    /**
    * Toggle status published/closed secara manual oleh perusahaan.
    */

    public function toggleStatus( Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );

        if ( $lowongan->status === 'published' ) {
            $lowongan->update( [ 'status' => 'closed' ] );
        } elseif ( $lowongan->status === 'closed' ) {
            $lowongan->update( [ 'status' => 'published' ] );
        }

        return back()->with( 'ok', 'Status lowongan diperbarui.' );
    }

    /**
    * Hapus lowongan.
    */

    public function destroy( Lowongan $lowongan ) {
        $this->ensureOwner( $lowongan );

        $lowongan->delete();

        return back()->with( 'ok', 'Lowongan dihapus.' );
    }
}
