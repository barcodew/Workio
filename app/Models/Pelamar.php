<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelamar extends Model {
    protected $fillable = [
        'user_id',
        'tanggal_lahir',
        'alamat',
        'telepon',
        'pendidikan',
        'keterampilan',
        'cv_path',
        'riwayat_pekerjaan',
        // kalau nanti punya field lain seperti 'tentang', boleh ditambahkan di sini
    ];

    protected $casts = [
        'tanggal_lahir'     => 'date',
        'pendidikan'        => 'array',
        'keterampilan'      => 'array',
        'riwayat_pekerjaan' => 'array',
    ];

    public function user() {
        return $this->belongsTo( User::class );
    }

    public function lamarans() {
        return $this->hasMany( Lamaran::class, 'user_id', 'user_id' );
    }
    /**
    * normalized_skills
    * -> array lowercase, trim, tanpa elemen kosong.
    * contoh: [ 'laravel', 'react', 'vue' ]
    */

    public function getNormalizedSkillsAttribute(): array {
        // manfaatkan helper normalizeList supaya lebih konsisten
        $skills = $this->normalizeList( $this->keterampilan ?? [] );

        return collect( $skills )
        ->map( fn ( $v ) => mb_strtolower( $v ) )
        ->filter()
        ->values()
        ->all();
    }

    /**
    * Helper: normalisasi list ( array / JSON string / teks multiline )
    * jadi array string yang sudah di-trim dan dibuang yang kosong.
    */
    protected function normalizeList( $value ): array {
        // Kalau sudah array ( karena cast ), beresin saja
        if ( is_array( $value ) ) {
            return collect( $value )
            ->map( fn ( $v ) => trim( ( string ) $v ) )
            ->filter()
            ->values()
            ->all();
        }

        // Kalau string, coba decode JSON dulu
        if ( is_string( $value ) && $value !== '' ) {
            $decoded = json_decode( $value, true );
            if ( is_array( $decoded ) ) {
                return collect( $decoded )
                ->map( fn ( $v ) => trim( ( string ) $v ) )
                ->filter()
                ->values()
                ->all();
            }

            // fallback: pecah per baris
            return collect( preg_split( '/\r\n|\n|\r/', $value ) )
            ->map( fn ( $v ) => trim( ( string ) $v ) )
            ->filter()
            ->values()
            ->all();
        }

        return [];
    }

    /**
    * Atribut virtual: progress kelengkapan profil ( % ).
    *
    * Item yang dinilai:
    * - Foto profil ( users.avatar_path )
    * - Tanggal lahir
    * - Telepon
    * - Alamat
    * - CV
    * - Riwayat pendidikan
    * - Keterampilan
    * - Riwayat pekerjaan
    */

    public function getProfileProgressAttribute(): int {
        $user = $this->user;

        // FOTO PROFIL ( avatar di tabel users )
        $hasAvatar = $user && !empty( $user->avatar_path );

        // TANGGAL LAHIR
        $hasTanggalLahir = !empty( $this->tanggal_lahir );

        // TELEPON & ALAMAT
        $hasTelepon = !empty( $this->telepon );
        $hasAlamat  = !empty( $this->alamat );

        // CV
        $hasCv = !empty( $this->cv_path );

        // RIWAYAT PENDIDIKAN
        $pendidikanList = $this->normalizeList( $this->pendidikan );
        $hasPendidikan  = count( $pendidikanList ) > 0;

        // KETERAMPILAN
        $skillList = $this->normalizeList( $this->keterampilan );
        $hasSkill  = count( $skillList ) > 0;

        // RIWAYAT PEKERJAAN
        $workList = $this->normalizeList( $this->riwayat_pekerjaan );
        $hasWork  = count( $workList ) > 0;

        // daftar item biner
        $items = [
            $hasAvatar,
            $hasTanggalLahir,
            $hasTelepon,
            $hasAlamat,
            $hasCv,
            $hasPendidikan,
            $hasSkill,
            $hasWork,
        ];

        $total  = count( $items );
        $filled = collect( $items )->filter()->count();

        return $total > 0 ? ( int ) round( ( $filled / $total ) * 100 ) : 0;
    }
}
