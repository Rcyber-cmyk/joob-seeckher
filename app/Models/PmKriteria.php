<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PmKriteria extends Model
{
    protected $table = 'pm_kriteria';
    protected $fillable = ['nama_kriteria', 'jenis_faktor', 'persentase_faktor'];

    public function subKriteria()
    {
        return $this->hasMany(PmSubKriteria::class, 'kriteria_id');
    }
}
