<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PmHasilAkhir extends Model
{
    protected $table = 'pm_hasil_akhir';
    protected $fillable = ['lamaran_id', 'skor_core', 'skor_secondary', 'skor_total'];

    public function lamaran()
    {
        return $this->belongsTo(Lamaran::class, 'lamaran_id');
    }
}
