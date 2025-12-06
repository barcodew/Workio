<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Perusahaan;
use App\Models\Lamaran;
use App\Models\User;

class Lowongan extends Model
{
    protected $table = 'lowongans';

    protected $fillable = [
        'perusahaan_id',
        'judul',
        'deskripsi',
        'kualifikasi',
        'keahlian',
        'lokasi',
        'tipe_pekerjaan',
        'deadline',
        'status',
    ];

    protected $casts = [
        'keahlian' => 'array',
        'deadline' => 'date',
    ];

    public function perusahaan()
    {
        return $this->belongsTo(Perusahaan::class);
    }

    
    public function lamarans()
    {
        return $this->hasMany(Lamaran::class);
    }

    /* ==========================
     *  FILTER
     * ========================== */
    public function scopeFilter($query, array $filters)
    {
        $query
            // cari judul / deskripsi
            ->when($filters['q'] ?? null, function ($q, $search) {
                $search = trim($search);

                $q->where(function ($qq) use ($search) {
                    $qq->where('judul', 'like', "%{$search}%")
                       ->orWhere('deskripsi', 'like', "%{$search}%");
                });
            })

            // lokasi
            ->when($filters['lokasi'] ?? null, function ($q, $lokasi) {
                $lokasi = trim($lokasi);
                $q->where('lokasi', 'like', "%{$lokasi}%");
            })

            // tipe kerja
            ->when($filters['tipe'] ?? null, function ($q, $tipe) {
                $q->where('tipe_pekerjaan', $tipe);
            })

            // filter berdasarkan skill dari request('skill')
            ->when($filters['skill'] ?? null, function ($q, $skill) {
                $skill = mb_strtolower(trim($skill));

                // karena kolom keahlian disimpan JSON (cast array),
                // kita tetap bisa LIKE string-nya (cukup untuk simple search)
                $q->whereRaw('LOWER(keahlian) LIKE ?', ["%{$skill}%"]);
            });
    }
 

     public function scopeNotExpired($query)
    {
        return $query->whereDate('deadline', '>=', now()->toDateString());
    }
}
