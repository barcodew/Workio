<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model {
    protected $fillable = [ 'lowongan_id', 'user_id', 'tanggal_lamar', 'status', 'file_cv', 'surat_lamaran' ];

    public function lowongan() {
        return $this->belongsTo( Lowongan::class );
    }

    public function pelamar() {
        return $this->belongsTo( User::class, 'user_id' );
    }
}
