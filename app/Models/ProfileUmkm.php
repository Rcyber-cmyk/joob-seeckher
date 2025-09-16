<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileUmkm extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'profiles_umkm';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama_usaha',
        'nama_pemilik',
        'alamat_usaha',
        'kota',
        'no_hp_umkm',
        'kategori_usaha',
        'deskripsi_usaha',
        'situs_web_atau_medsos',
        'logo_usaha',
    ];

    /**
     * Get the user that owns the UMKM profile.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}