<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('spk_hasil_penilaian', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ke tabel lamaran yang sudah kamu buat
            $table->foreignId('lamaran_id')->constrained('lamaran')->onDelete('cascade');
            
            // Menyimpan nilai perhitungan
            $table->decimal('nilai_core_factor', 8, 2)->nullable();
            $table->decimal('nilai_secondary_factor', 8, 2)->nullable();
            $table->decimal('nilai_total', 8, 2)->nullable();
            
            // Opsional: untuk menyimpan peringkat setelah dihitung semua
            $table->integer('ranking')->nullable(); 
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spk_hasil_penilaian');
    }
};