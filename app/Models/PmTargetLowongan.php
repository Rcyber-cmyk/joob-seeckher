<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PmTargetLowongan extends Model
{
    protected $table = 'pm_target_lowongan';
    protected $fillable = ['lowongan_id', 'kriteria_id', 'nilai_target'];

    public function lowongan()
    {
        return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(PmKriteria::class, 'kriteria_id');
    }
}
