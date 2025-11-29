<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use App\Models\Pelamar;
use Illuminate\Support\Facades\Auth;

class PelamarProfileController extends Controller {
    public function edit() {
        $user    = auth()->user();
        $pelamar = $user->pelamar;
        // relasi ada di model User
        return view( 'pelamar.profil.edit', compact( 'user', 'pelamar' ) );
    }

    public function update( Request $request ) {
        $user    = auth()->user();
        $pelamar = $user->pelamar;
        // pastikan relasi sudah benar

        $validated = $request->validate( [
            'name'          => [ 'required', 'string', 'max:100' ],
            'tanggal_lahir' => [
                'nullable',
                'date',

                function ( $attribute, $value, $fail ) {
                    if ( !$value ) {
                        return;
                    }

                    try {
                        $birthDate = Carbon::parse( $value );
                    } catch ( \Exception $e ) {
                        return $fail( 'Tanggal lahir tidak valid.' );
                    }

                    // minimal 18 tahun
                    $minDate = Carbon::now()->subYears( 18 );

                    if ( $birthDate->greaterThan( $minDate ) ) {
                        $fail( 'Umur minimal 18 tahun untuk menggunakan Workio.' );
                    }
                }
                ,
            ],
            'telepon'       => [ 'nullable', 'string', 'max:20' ],
            'alamat'        => [ 'nullable', 'string', 'max:255' ],
            'pendidikan'    => [ 'nullable' ],
            'keterampilan'  => [ 'nullable' ],
            'riwayat_pekerjaan' => [ 'nullable' ],
            'cv'            => [ 'nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048' ],
            'avatar'        => [ 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024' ],
        ] );

        /* === UPDATE NAMA USER === */
        $user->name = $validated[ 'name' ];

        /* === AVATAR === */
        if ( $request->hasFile( 'avatar' ) ) {
            // hapus file lama jika ada
            if ( $user->avatar_path && Storage::disk( 'public' )->exists( $user->avatar_path ) ) {
                Storage::disk( 'public' )->delete( $user->avatar_path );
            }

            // simpan file baru ke storage/app/public/avatars
            $path = $request->file( 'avatar' )->store( 'avatars', 'public' );

            // update kolom di tabel users
            $user->avatar_path = $path;
        }

        // simpan perubahan user ( nama + avatar kalau ada )
        $user->save();

        /* === CV === */
        if ( $request->hasFile( 'cv' ) ) {
            if ( $pelamar->cv_path && Storage::disk( 'public' )->exists( $pelamar->cv_path ) ) {
                Storage::disk( 'public' )->delete( $pelamar->cv_path );
            }

            $cvPath = $request->file( 'cv' )->store( 'cv', 'public' );
            $pelamar->cv_path = $cvPath;
        }

        // array input -> bersihkan yg kosong
        $pendidikan       = array_filter( $request->input( 'pendidikan', [] ), fn( $v ) => trim( $v ) !== '' );
        $keterampilan     = array_filter( $request->input( 'keterampilan', [] ), fn( $v ) => trim( $v ) !== '' );
        $riwayatPekerjaan = array_filter( $request->input( 'riwayat_pekerjaan', [] ), fn( $v ) => trim( $v ) !== '' );

        // simpan field sederhana di pelamar
        $pelamar->tanggal_lahir     = $validated[ 'tanggal_lahir' ] ?? null;
        $pelamar->telepon           = $validated[ 'telepon' ] ?? null;
        $pelamar->alamat            = $validated[ 'alamat' ] ?? null;

        // simpan sebagai array ( otomatis jadi JSON karena casts di model )
        $pelamar->pendidikan        = array_values( $pendidikan );
        $pelamar->keterampilan      = array_values( $keterampilan );
        $pelamar->riwayat_pekerjaan = array_values( $riwayatPekerjaan );

        $pelamar->save();

        return redirect()
        ->route( 'pelamar.profil.edit' )
        ->with( 'ok', 'Profil berhasil diperbarui.' );
    }

   public function show(Pelamar $pelamar)
    {
        // muat user + relasi lain kalau perlu
        $pelamar->load('user');

        // semua lamaran si pelamar (lengkap dengan lowongan & perusahaan)
        $lamarans = $pelamar->lamarans()
            ->with(['lowongan.perusahaan'])
            ->orderByDesc('tanggal_lamar')
            ->get();

        return view('guest.pelamar.show', [
            'pelamar'  => $pelamar,
            'lamarans' => $lamarans,
        ]);
    }

}