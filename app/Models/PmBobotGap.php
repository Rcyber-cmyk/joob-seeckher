<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PmBobotGap extends Model
{
    protected $table = 'pm_bobot_gap';
    protected $fillable = ['selisih_gap', 'bobot_nilai', 'keterangan'];
}
