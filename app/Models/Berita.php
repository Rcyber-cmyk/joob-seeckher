<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    // Kolom yang dapat diisi massal
    protected $fillable = [
        'kategori_id',
        'judul',
        // 'slug', <--- Hapus slug dari sini karena sudah dibuat oleh Mutator
        'gambar',
        'kutipan',
        'isi_berita',
        'is_featured',
        'published_at',
    ];

    // Relasi ke tabel Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    // Mutator: Otomatis membuat slug sebelum menyimpan
    public function setJudulAttribute($value)
    {
        $this->attributes['judul'] = $value;
        // Pastikan slug dibuat hanya jika judul diatur
        $this->attributes['slug'] = Str::slug($value);
    }
}