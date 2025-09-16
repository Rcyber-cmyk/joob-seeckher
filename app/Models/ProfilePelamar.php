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
        'foto_profil', // <-- TAMBAHKAN INI
        'nik', 
        'alamat', 
        'tanggal_lahir', 
        'domisili',
        'lulusan',
        'tahun_lulus', 
        'nilai_akhir',
        'pengalaman_kerja',
        'gender', 
        'no_hp', 
        'foto_ktp',
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
     * Relasi ke lowongan pekerjaan yang disimpan oleh pelamar.
     */
    public function lowonganTersimpan()
    {
        return $this->belongsToMany(LowonganPekerjaan::class, 'lowongan_tersimpan', 'pelamar_id', 'lowongan_id')->withTimestamps();
    }

    /**
     * Relasi ke model Lamaran.
     */
    public function lamaran()
    {
        return $this->hasMany(Lamaran::class, 'pelamar_id');
    }

    /**
     * Accessor untuk menghitung persentase kelengkapan profil secara dinamis.
     */
    public function getKelengkapanProfilAttribute(): int
    {
        // PERBAIKAN: Menghitung persentase berdasarkan 'foto_ktp'
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
            'foto_ktp',
        ];

        $totalFields = count($fields);
        $filledFields = 0;

        foreach ($fields as $field) {
            if (!empty($this->attributes[$field])) {
                $filledFields++;
            }
        }

        return $totalFields > 0 ? round(($filledFields / $totalFields) * 100) : 0;
    }
}