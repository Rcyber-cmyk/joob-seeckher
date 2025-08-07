<?php

// ... (use statement)
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('jadwal_wawancara', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lowongan_id')->constrained('lowongan_pekerjaan')->onDelete('cascade');
            $table->foreignId('pelamar_id')->constrained('profiles_pelamar')->onDelete('cascade');
            $table->string('metode_wawancara');
            $table->string('lokasi_interview')->nullable();
            $table->string('link_zoom')->nullable();
            $table->date('tanggal_interview');
            $table->time('waktu_interview');
            $table->text('deskripsi')->nullable();
            $table->string('status')->default('terjadwal'); // Misalnya: terjadwal, selesai, dibatalkan
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwal_wawancara');
    }
};
