<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Pastikan Anda mengimpor model yang berelasi
use App\Models\JadwalWawancara;
use App\Models\ProfilePelamar; 

class FormIsianInterview extends Model
{
    use HasFactory;

    protected $table = 'form_isian_interview';
    
    protected $fillable = [
        'jadwal_id', 
        'pelamar_id', 
        'catatan_interviewer', 
        'nilai_kandidat', 
        'rekomendasi', 
        'data_tambahan_pelamar',
        'tanggal_diisi'
    ];
    
    // Casting JSON agar otomatis menjadi array/object PHP
    protected $casts = [
        'data_tambahan_pelamar' => 'array',
        'tanggal_diisi' => 'datetime',
    ];

    /**
     * Relasi ke jadwal wawancara yang terkait (One-to-One)
     */
    public function jadwal()
    {
        return $this->belongsTo(JadwalWawancara::class, 'jadwal_id');
    }
    
    /**
     * Relasi ke pelamar yang mengisi
     */
    public function pelamar()
    {
        return $this->belongsTo(ProfilePelamar::class, 'pelamar_id');
    }
}