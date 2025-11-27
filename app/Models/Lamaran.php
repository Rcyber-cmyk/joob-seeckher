<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lamaran extends Model
{
    use HasFactory;

    protected $table = 'lamaran';

    protected $fillable = [
        'pelamar_id',
        'lowongan_id',
        'status',
        'surat_lamaran_path', 
        'resume_path',
        'surat_lamaran_text', // Tambahkan juga ini jika digunakan
        'gaji_diharapkan',
        'pendidikan_terakhir',
        'pengalaman_tahun',
        'riwayat_karir',
        'deskripsi_kemampuan',
    ];

    public function pelamar()
    {
        return $this->belongsTo(ProfilePelamar::class, 'pelamar_id');
    }

    public function lowongan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }
}