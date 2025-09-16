<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable  // <-- TAMBAHKAN "implements MustVerifyEmail"
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi ke profil pelamar (jika role-nya pelamar).
     */
    public function profilePelamar()
    {
        return $this->hasOne(ProfilePelamar::class);
    }

    /**
     * Relasi ke profil perusahaan (jika role-nya perusahaan).
     */
    public function profilePerusahaan()
    {
        return $this->hasOne(ProfilePerusahaan::class);
    }

    /**
     * Relasi ke profil UMKM (jika role-nya umkm).
     */
    public function profileUmkm()
    {
        return $this->hasOne(ProfileUmkm::class);
    }
}
