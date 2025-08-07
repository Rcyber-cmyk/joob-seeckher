<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Keahlian;


class LowonganPekerjaan extends Model
{
    use HasFactory;
    
    protected $table = 'lowongan_pekerjaan';

    protected $fillable = [
        'perusahaan_id', 
        'judul_lowongan', 
        'deskripsi_pekerjaan', 
        'is_active',
        'domisili', // Tambahkan
        'tipe_pekerjaan', // Tambahkan
        'gender', // Tambahkan
        'pendidikan_terakhir', // Tambahkan
        'usia', // Tambahkan
        'nilai_pendidikan_terakhir', // Tambahkan
        'pengalaman_kerja', // Tambahkan
        'keahlian_bidang_pekerjaan' // Tambahkan
    ];

    public function perusahaan()
    {
        return $this->belongsTo(ProfilePerusahaan::class, 'perusahaan_id');
    }
    
    public function keahlianYangDibutuhkan()
    {
        return $this->belongsToMany(Keahlian::class, 'lowongan_keahlian_dibutuhkan', 'lowongan_id', 'keahlian_id');
    }

    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'lowongan_id');
    }
}