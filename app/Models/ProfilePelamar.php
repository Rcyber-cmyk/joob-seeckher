<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ProfilePelamar extends Model
{
    use HasFactory;
    
    protected $table = 'profiles_pelamar';

    protected $fillable = [
        'user_id', 
        'nama_lengkap', 
        'nik', 
        'alamat', 
        'tanggal_lahir', 
        'domisili',
        'lulusan',
        'tahun_lulus', 
        'pengalaman_kerja',
        'gender', 
        'no_hp', 
        'file_cv', 
        'tentang_saya'
    ];

    /**
     * Relasi ke model User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi ke model Keahlian.
     */
    public function keahlian()
    {
        return $this->belongsToMany(Keahlian::class, 'pelamar_keahlian', 'pelamar_id', 'keahlian_id');
    }

    /**
     * Accessor untuk menghitung persentase kelengkapan profil secara dinamis.
     */
    public function getKelengkapanProfilAttribute(): int
    {
        // Daftar semua field yang dianggap penting untuk kelengkapan profil
        $fields = [
            'nik',
            'alamat',
            'tanggal_lahir',
            'domisili',
            'lulusan',
            'tahun_lulus',
            'pengalaman_kerja',
            'gender',
            'no_hp',
            'file_cv', // Anda bisa memasukkan file_cv jika dianggap wajib
        ];

        $totalFields = count($fields);
        $filledFields = 0;

        foreach ($fields as $field) {
            // Periksa apakah atribut tidak kosong atau null
            if (!empty($this->attributes[$field])) {
                $filledFields++;
            }
        }

        // Hitung persentase dan bulatkan
        return $totalFields > 0 ? round(($filledFields / $totalFields) * 100) : 0;
    }
}
