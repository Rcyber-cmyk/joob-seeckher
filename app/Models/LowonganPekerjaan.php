<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Keahlian;


class LowonganPekerjaan extends Model
{
    use HasFactory;
    
    protected $table = 'lowongan_pekerjaan';

    /**
     * The attributes that are mass assignable.
     * Pastikan semua field dari form dan database ada di sini.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'perusahaan_id',
        'judul_lowongan',
        'deskripsi_pekerjaan',
        'is_active',
        'domisili',
        'tipe_pekerjaan',
        'gender',
        'pendidikan_terakhir',
        'usia_maks', // [DIUBAH] Mengganti 'usia' menjadi 'usia_maks' agar konsisten
        'usia_min',
        'nilai_pendidikan_terakhir',
        'pengalaman_kerja', // Ini adalah min
        'pengalaman_kerja_maks',
        'keahlian_bidang_pekerjaan',

        // Semua bobot harus ada di sini
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
    
    public function keahlianDibutuhkan()
    {
        return $this->belongsToMany(Keahlian::class, 'lowongan_keahlian_dibutuhkan', 'lowongan_id', 'keahlian_id');
    }


    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'lowongan_id');
    }
}

