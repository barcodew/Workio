<?php

namespace App\Http\Controllers;

use App\Models\Perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePerusahaanController extends Controller {
    public function edit() {
        $perusahaan = auth()->user()->perusahaan;

        return view( 'perusahaan.profil.edit', compact( 'perusahaan' ) );
    }

    public function update( Request $request ) {
        $user = auth()->user();
        $perusahaan = $user->perusahaan;

        if ( ! $perusahaan ) {
            $perusahaan = Perusahaan::create( [
                'user_id' => $user->id,
            ] );
        }

        $data = $request->validate( [
            'nama_perusahaan'  => 'required|string|max:150',
            'telepon'          => 'nullable|string|max:50',
            'email_kantor'     => 'nullable|email|max:255',
            'website'          => 'nullable|url|max:255',
            'alamat'           => 'nullable|string|max:255',
            'kota'             => 'nullable|string|max:130',
            'provinsi'         => 'nullable|string|max:100',
            'kode_pos'         => 'nullable|string|max:20',
            'deskripsi'        => 'nullable|string',
            'linkedin'         => 'nullable|url|max:255',
            'instagram'        => 'nullable|url|max:255',
            'facebook'         => 'nullable|url|max:255',

            // pakai BIDANG_USAHA sebagai industri
            'bidang_usaha'     => 'nullable|string|max:100',

            'jumlah_karyawan'  => 'nullable|string|max:50',
            'tahun_berdiri'    => 'nullable|integer|min:1900|max:' . date( 'Y' ),

            'logo'             => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'banner'           => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ] );

        // upload logo
        if ( $request->hasFile( 'logo' ) ) {
            if ( $perusahaan->logo_path && Storage::disk( 'public' )->exists( $perusahaan->logo_path ) ) {
                Storage::disk( 'public' )->delete( $perusahaan->logo_path );
            }
            $data[ 'logo_path' ] = $request->file( 'logo' )->store( 'perusahaan/logo', 'public' );
        }

        // upload banner
        if ( $request->hasFile( 'banner' ) ) {
            if ( $perusahaan->banner_path && Storage::disk( 'public' )->exists( $perusahaan->banner_path ) ) {
                Storage::disk( 'public' )->delete( $perusahaan->banner_path );
            }
            $data[ 'banner_path' ] = $request->file( 'banner' )->store( 'perusahaan/banner', 'public' );
        }

        $perusahaan->update( $data );

        return redirect()
        ->route( 'perusahaan.profil.edit' )
        ->with( 'ok', 'Profil perusahaan berhasil diperbarui.' );
    }
}
