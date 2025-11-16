<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var list<string>
    */
    
    protected $fillable = [ 'name', 'email', 'password', 'role' ];

    public function pelamar() {
        return $this->hasOne( Pelamar::class );
    }

    public function perusahaan() {
        return $this->hasOne( Perusahaan::class );
    }

    public function lamarans() {
        return $this->hasMany( Lamaran::class );
    }

    public function scopeRole( $q, string $role ) {
        return $q->where( 'role', $role );
    }

    public function isPelamar() {
        return $this->role === 'pelamar';
    }

    public function isPerusahaan() {
        return $this->role === 'perusahaan';
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }

    /**
    * The attributes that should be hidden for serialization.
    *
    * @var list<string>
    */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
    * Get the attributes that should be cast.
    *
    * @return array<string, string>
    */
    protected function casts(): array {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
