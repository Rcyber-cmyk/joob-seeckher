<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UndanganLamaran extends Model
    {
        use HasFactory;

        /**
         * The table associated with the model.
         *
         * @var string
         */
        protected $table = 'undangan_lamaran';

        /**
         * The attributes that are mass assignable.
         *
         * @var array<int, string>
         */
        protected $fillable = [
            'perusahaan_id',
            'pelamar_id',
            'lowongan_id',
            'status',
            'pesan',
        ];

        /**
         * Get the perusahaan that sent the invitation.
         */
        public function perusahaan(): BelongsTo
        {
            return $this->belongsTo(ProfilePerusahaan::class, 'perusahaan_id');
        }

        /**
         * Get the pelamar who received the invitation.
         */
        public function pelamar(): BelongsTo
        {
            return $this->belongsTo(ProfilePelamar::class, 'pelamar_id');
        }

        /**
         * Get the lowongan associated with the invitation.
         */
        public function lowongan(): BelongsTo
        {
            return $this->belongsTo(LowonganPekerjaan::class, 'lowongan_id');
        }
    }
    
