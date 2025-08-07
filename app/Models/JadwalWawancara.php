<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalWawancara extends Model
{
    use HasFactory;

    protected $table = 'jadwal_wawancara';
    
    protected $fillable = [
        'lowongan_id',
        'pelamar_id',
        'metode_wawancara',
        'lokasi_interview',
        'link_zoom',
        'tanggal_interview',
        'waktu_interview',
        'deskripsi',
        'status',
    ];

    /**
     * Relasi ke lowongan pekerjaan
     */
    public function lowongan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }

    /**
     * Relasi ke profil pelamar
     */
    public function pelamar()
    {
        return $this->belongsTo(ProfilePelamar::class, 'pelamar_id');
    }
}