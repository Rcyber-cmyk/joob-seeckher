<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IklanPayment extends Model
{
    use HasFactory;

    /**
     * Nama tabel
     */
    protected $table = 'iklan_payments';

    /**
     * Kolom yang bisa diisi
     */
    protected $fillable = [
        'perusahaan_id',
        'lowongan_id',
        'total_bayar',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status',
    ];

    /**
     * Relasi ke Perusahaan
     */
    public function perusahaan()
    {
        // Sesuaikan jika nama model ProfilePerusahaan Anda berbeda
        return $this->belongsTo(ProfilePerusahaan::class, 'perusahaan_id');
    }

    /**
     * Relasi ke Lowongan
     */
    public function lowongan()
    {
        // Sesuaikan jika nama model LowonganPekerjaan Anda berbeda
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }
}