<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model {
    protected $fillable = [ 'user_id', 'tanggal_lahir', 'alamat', 'telepon', 'pendidikan', 'keterampilan', 'cv_path' ];

    protected $casts = [
        'tanggal_lahir' => 'date',
    ];

    public function user() {
        return $this->belongsTo( User::class );
    }
}
