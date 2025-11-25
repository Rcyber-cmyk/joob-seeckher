<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Pastikan Anda mengimpor semua model yang berelasi
use App\Models\LowonganPekerjaan;
use App\Models\ProfilePelamar; // Asumsi nama model profil pelamar Anda adalah ProfilePelamar
use App\Models\FormIsianInterview; // Model baru

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
        // --- KOLOM BARU UNTUK FUNGSI FORMULIR ---
        'form_status',          // Status pengisian: 'Belum Diisi', 'Terkirim', 'Sudah Diisi', 'Ditolak'
        'form_submission_id',   // FK ke hasil isian di form_isian_interview
        'form_token',           // Token unik untuk akses link pengisian
        'token_expires_at',     // Waktu kedaluwarsa token
        // ----------------------------------------
    ];

    protected $casts = [
        'tanggal_interview' => 'date',
        'token_expires_at' => 'datetime',
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
        // Sesuaikan nama Model ProfilePelamar jika berbeda di proyek Anda
        return $this->belongsTo(ProfilePelamar::class, 'pelamar_id');
    }
    
    /**
     * Relasi ke hasil isian formulir (FormIsianInterview)
     * Menggunakan form_submission_id (FK)
     */
    public function formIsian()
    {
        return $this->belongsTo(FormIsianInterview::class, 'form_submission_id');
    }
}