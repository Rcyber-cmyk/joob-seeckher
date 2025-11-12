<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IklanLowongan extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'iklan_lowongan';

    /**
     * Kolom yang Boleh Diisi (Mass Assignment)
     * INI PENTING AGAR TIDAK GAGAL SEPERTI TADI
     */
    protected $fillable = [
        'perusahaan_id',
        'judul',
        'deskripsi',
        'paket',
        'status',
        'file_iklan_banner',
        'metode_pembayaran',
        'bukti_pembayaran',
        'total_bayar',
        'published_at',
        'expires_at',
    ];

    /**
     * Tipe data untuk kolom tanggal
     */
    protected $casts = [
        'published_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    /**
     * Relasi ke perusahaan
     */
    public function perusahaan()
    {
        return $this->belongsTo(ProfilePerusahaan::class, 'perusahaan_id');
    }
}