<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lowongan extends Model {
    protected $fillable = [ 'perusahaan_id', 'judul', 'deskripsi', 'kualifikasi', 'lokasi', 'tipe_pekerjaan', 'deadline', 'status' ];

    public function perusahaan() {
        return $this->belongsTo( Perusahaan::class );
    }


    public function lamarans() {
        return $this->hasMany( \App\Models\Lamaran::class );
    }

    public function scopeFilter( $q, array $f ) {
        return $q
        ->when( $f[ 'q' ] ?? null, fn( $qq, $v )=>$qq->where( fn( $w )=>$w
        ->where( 'judul', 'like', "%$v%" )->orWhere( 'deskripsi', 'like', "%$v%" ) ) )
        ->when( $f[ 'lokasi' ] ?? null, fn( $qq, $v )=>$qq->where( 'lokasi', 'like', "%$v%" ) )
        ->when( $f[ 'tipe' ] ?? null, fn( $qq, $v )=>$qq->where( 'tipe_pekerjaan', $v ) )
        ->when( $f[ 'status' ] ?? 'published', fn( $qq, $v )=>$qq->where( 'status', $v ) )
        ->latest();
    }
}
