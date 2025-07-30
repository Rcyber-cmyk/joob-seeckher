<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePerusahaan extends Model
{
    use HasFactory;

    protected $table = 'profiles_perusahaan';
    
    protected $fillable = [
        'user_id', 'nama_perusahaan', 'alamat_perusahaan', 'situs_web', 'deskripsi'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowonganPekerjaan()
    {
        return $this->hasMany(LowonganPekerjaan::class, 'perusahaan_id');
    }
}