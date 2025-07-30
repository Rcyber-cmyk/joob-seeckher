<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keahlian extends Model
{
    use HasFactory;

    protected $table = 'keahlian';
    protected $fillable = ['nama_keahlian'];
    public $timestamps = false; // Tidak menggunakan created_at/updated_at

    public function profilesPelamar()
    {
        return $this->belongsToMany(ProfilePelamar::class, 'pelamar_keahlian', 'keahlian_id', 'pelamar_id');
    }
    public function bidangKeahlian()
    {
        return $this->belongsTo(BidangKeahlian::class);
    }
}