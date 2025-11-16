<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        // sesuaikan dengan relasi milikmu

        $validated = $request->validate( [
            'tanggal_lahir' => [ 'nullable', 'date' ],
            'telepon'       => [ 'nullable', 'string', 'max:20' ],
            'alamat'        => [ 'nullable', 'string', 'max:255' ],
            'pendidikan'    => [ 'nullable', 'string' ],
            'keterampilan'  => [ 'nullable', 'string' ],
            'cv'            => [ 'nullable', 'file', 'mimes:pdf,doc,docx', 'max:2048' ],   // 2MB
            'avatar'        => [ 'nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024' ], // 1MB ( KB )
        ] );

        /* ===  === AVATAR ===  === */
        if ( $request->hasFile( 'avatar' ) ) {
            // hapus file lama jika ada
            if ( $user->avatar_path && Storage::disk( 'public' )->exists( $user->avatar_path ) ) {
                Storage::disk( 'public' )->delete( $user->avatar_path );
            }

            // simpan file baru ke storage/app/public/avatars
            $path = $request->file( 'avatar' )->store( 'avatars', 'public' );

            // update kolom di tabel users
            $user->avatar_path = $path;
            $user->save();
        }

        /* ===  === CV ( sesuaikan dengan kode lamamu ) ===  === */
        if ( $request->hasFile( 'cv' ) ) {
            if ( $pelamar->cv_path && Storage::disk( 'public' )->exists( $pelamar->cv_path ) ) {
                Storage::disk( 'public' )->delete( $pelamar->cv_path );
            }

            $cvPath = $request->file( 'cv' )->store( 'cv', 'public' );
            $pelamar->cv_path = $cvPath;
        }

        $pelamar->tanggal_lahir = $validated[ 'tanggal_lahir' ] ?? null;
        $pelamar->telepon       = $validated[ 'telepon' ] ?? null;
        $pelamar->alamat        = $validated[ 'alamat' ] ?? null;
        $pelamar->pendidikan    = $validated[ 'pendidikan' ] ?? null;
        $pelamar->keterampilan  = $validated[ 'keterampilan' ] ?? null;
        $pelamar->save();

        return redirect()
        ->route( 'pelamar.profil.edit' )
        ->with( 'ok', 'Profil berhasil diperbarui.' );
    }
}