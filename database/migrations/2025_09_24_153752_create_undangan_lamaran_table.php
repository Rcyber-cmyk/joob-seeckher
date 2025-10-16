<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('undangan_lamaran', function (Blueprint $table) {
            $table->id();

            // Pastikan nama tabel referensi sesuai dengan tabel aslinya
            $table->foreignId('perusahaan_id')
                ->constrained('profile_perusahaan') // singular
                ->onDelete('cascade');

            $table->foreignId('pelamar_id')
                ->constrained('profile_pelamar') // pastikan nama tabel ini benar
                ->onDelete('cascade');

            $table->foreignId('lowongan_id')
                ->constrained('lowongan_pekerjaan')
                ->onDelete('cascade');

            $table->enum('status', ['terkirim', 'dilihat', 'diterima', 'ditolak'])->default('terkirim');
            $table->text('pesan')->nullable();
            $table->timestamps();

            $table->unique(['pelamar_id', 'lowongan_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('undangan_lamaran');
    }
};
