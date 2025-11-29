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

    /* ==========================
     *  Helper: required skills (normalized)
     * ========================== */
    public function getRequiredSkillsAttribute(): array
    {
        // kalau di DB masih string "Laravel, React"
        if (is_string($this->keahlian)) {
            return collect(preg_split('/[,;]+/', $this->keahlian))
                ->map(fn ($v) => mb_strtolower(trim($v)))
                ->filter()
                ->values()
                ->all();
        }

        // kalau sudah array dari cast
        if (is_array($this->keahlian)) {
            return collect($this->keahlian)
                ->map(fn ($v) => mb_strtolower(trim($v)))
                ->filter()
                ->values()
                ->all();
        }

        return [];
    }

    /* ==========================
     *  Match score vs user pelamar
     * ========================== */

    // persen kecocokan
    public function matchScoreForUser(User $user): int
    {
        $pelamar = $user->pelamar;
        if (!$pelamar) {
            return 0;
        }

        $userSkills = collect($pelamar->normalized_skills ?? []); // accessor di model Pelamar
        $jobSkills  = collect($this->required_skills);

        if ($userSkills->isEmpty() || $jobSkills->isEmpty()) {
            return 0;
        }

        $match = $jobSkills->intersect($userSkills);

        return (int) round(($match->count() / $jobSkills->count()) * 100);
    }

    // daftar skill yang cocok
    public function matchedSkillsForUser(User $user): array
    {
        $pelamar = $user->pelamar;
        if (!$pelamar) {
            return [];
        }

        $userSkills = collect($pelamar->normalized_skills ?? []);
        $jobSkills  = collect($this->required_skills);

        return $jobSkills
            ->intersect($userSkills)
            ->map(fn ($s) => strtoupper($s))
            ->values()
            ->all();
    }

     public function scopeNotExpired($query)
    {
        return $query->whereDate('deadline', '>=', now()->toDateString());
    }
}
