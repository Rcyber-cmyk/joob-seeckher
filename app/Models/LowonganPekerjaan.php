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
        'perusahaan_id', 'judul_lowongan', 'deskripsi_pekerjaan', 'is_active'
    ];

    public function perusahaan()
    {
        return $this->belongsTo(ProfilePerusahaan::class, 'perusahaan_id');
    }
    
    public function keahlianYangDibutuhkan()
    {
        return $this->belongsToMany(Keahlian::class, 'lowongan_keahlian_dibutuhkan', 'lowongan_id', 'keahlian_id');
    }
}