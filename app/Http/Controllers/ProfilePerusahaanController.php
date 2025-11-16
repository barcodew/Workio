<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilePerusahaanController extends Controller
{
    public function edit()
    {
        $perusahaan = auth()->user()->perusahaan; 
        return view('perusahaan.profil.edit', compact('perusahaan'));
    }

    public function update(Request $r)
    {
        $perusahaan = auth()->user()->perusahaan;

        $data = $r->validate([
            'nama_perusahaan' => 'required|string|max:150',
            'email_kantor'    => 'nullable|email|max:150',
            'telepon'         => 'nullable|string|max:50',
            'website'         => 'nullable|url|max:200',
            'alamat'          => 'nullable|string|max:255',
            'kota'            => 'nullable|string|max:100',
            'provinsi'        => 'nullable|string|max:100',
            'kode_pos'        => 'nullable|string|max:20',
            'deskripsi'       => 'nullable|string',
            'linkedin'        => 'nullable|url|max:200',
            'instagram'       => 'nullable|url|max:200',
            'facebook'        => 'nullable|url|max:200',
            'logo'            => 'nullable|image|mimes:jpg,jpeg,png,webp|max:1024',
            'banner'          => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload logo
        if ($r->hasFile('logo')) {
            // hapus lama
            if ($perusahaan->logo_path && Storage::disk('public')->exists($perusahaan->logo_path)) {
                Storage::disk('public')->delete($perusahaan->logo_path);
            }
            $data['logo_path'] = $r->file('logo')->store('company/logo', 'public');
        }

        // Upload banner
        if ($r->hasFile('banner')) {
            if ($perusahaan->banner_path && Storage::disk('public')->exists($perusahaan->banner_path)) {
                Storage::disk('public')->delete($perusahaan->banner_path);
            }
            $data['banner_path'] = $r->file('banner')->store('company/banner', 'public');
        }

        $perusahaan->update($data);

        return back()->with('ok', 'Profil perusahaan berhasil diperbarui.');
    }
}
