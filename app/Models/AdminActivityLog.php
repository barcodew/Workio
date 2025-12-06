<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class AdminActivityLog extends Model
{
    protected $fillable = [
        'user_id',
        'role',
        'action',
        'description',
        'lowongan_id',
        'perusahaan_id',
        'pelamar_id',
    ];

    public static function record(array $data): self
    {
        $user = Auth::user();

        return self::create([
            'user_id'       => $user?->id,
            'role'          => $user->role ?? null, // sesuaikan nama kolom role di tabel users
            'action'        => $data['action'],
            'description'   => $data['description'],
            'lowongan_id'   => $data['lowongan_id']   ?? null,
            'perusahaan_id' => $data['perusahaan_id'] ?? null,
            'pelamar_id'    => $data['pelamar_id']    ?? null,
        ]);
    }

    public function user()       { return $this->belongsTo(User::class); }
    public function lowongan()   { return $this->belongsTo(Lowongan::class); }
    public function perusahaan() { return $this->belongsTo(Perusahaan::class); }
    public function pelamar()    { return $this->belongsTo(Pelamar::class); }
}
