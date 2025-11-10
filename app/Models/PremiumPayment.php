<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProfilePerusahaan; // <-- PERBAIKAN: Hapus 's'

class PremiumPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'perusahaan_id',
        'paket',
        'total_bayar',
        'metode_pembayaran',
        'bukti_pembayaran',
        'status',
    ];

    public function perusahaan()
    {
        // ==========================================================
        // == PERBAIKAN DI SINI ==
        // ==========================================================
        return $this->belongsTo(ProfilePerusahaan::class, 'perusahaan_id'); // <-- Hapus 's'
    }
}