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
