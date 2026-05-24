<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PmSubKriteria extends Model
{
    protected $table = 'pm_sub_kriteria';
    protected $fillable = ['kriteria_id', 'nama_sub', 'nilai_profil'];

    public function kriteria()
    {
        return $this->belongsTo(PmKriteria::class, 'kriteria_id');
    }
}