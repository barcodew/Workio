<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perusahaan extends Model {
    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        'logo_path',    
        'banner_path',   
        'email_kantor',
        'telepon',
        'website',
        'alamat',
        'kota',
        'provinsi',
        'kode_pos',
        'deskripsi',
        'linkedin',
        'instagram',
        'facebook',
        'bidang_usaha',  
           'jumlah_karyawan',   // <--- baru
        'tahun_berdiri',     // <--- baru
    ];

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function lowongans() {
        return $this->hasMany( Lowongan::class );
    }
}
