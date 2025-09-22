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
        'domisili',
        'tipe_pekerjaan',
        'gender',
        'pendidikan_terakhir',
        'usia', // Ini akan menjadi usia_maks
        'usia_min', // BARU
        'nilai_pendidikan_terakhir',
        'pengalaman_kerja', // Ini akan menjadi pengalaman_kerja_min
        'pengalaman_kerja_maks', // BARU
        'keahlian_bidang_pekerjaan',
        'bobot_domisili',
        'bobot_usia',
        'bobot_gender',
        'bobot_pendidikan',
        'bobot_nilai',
        'bobot_pengalaman',
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