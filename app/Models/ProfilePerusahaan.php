<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute; // Tambahkan ini

class ProfilePerusahaan extends Model
{
    use HasFactory;

    protected $table = 'profiles_perusahaan';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'nama_perusahaan',
        // Kolom yang disesuaikan dengan database
        'alamat_jalan',
        'alamat_kota',
        'kode_pos',
        'no_telp_perusahaan',
        'npwp_perusahaan',
        // Kolom lama yang dipertahankan
        'situs_web',
        'deskripsi',
        'logo_perusahaan', // Tambahkan ini
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function lowonganPekerjaan()
    {
        return $this->hasMany(LowonganPekerjaan::class, 'perusahaan_id');
    }

    protected function namaPerusahaan(): Attribute
    {
        return Attribute::make(
            get: fn (string|null $value) => $value ?? $this->user->name,
        );
    }
    
    /**
     * Accessor untuk menghitung persentase kelengkapan profil secara dinamis.
     * Kita bisa tambahkan ini untuk dashboard
     */
    public function getKelengkapanProfilAttribute(): int
    {
        $fields = [
            'nama_perusahaan',
            'alamat_jalan',
            'alamat_kota',
            'no_telp_perusahaan',
            'npwp_perusahaan',
        ];

        $totalFields = count($fields);
        $filledFields = 0;

        foreach ($fields as $field) {
            if (!empty($this->attributes[$field])) {
                $filledFields++;
            }
        }
        
        // Tambahkan cek untuk relasi user
        if ($this->user && !empty($this->user->email)) {
             $filledFields++;
        }
        $totalFields++;

        // Hitung persentase dan bulatkan
        return $totalFields > 0 ? round(($filledFields / $totalFields) * 100) : 0;
    }
}
