<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
    Schema::create('pm_target_lowongan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lowongan_id')->constrained('lowongan_pekerjaan')->onDelete('cascade');
        $table->foreignId('kriteria_id')->constrained('pm_kriteria')->onDelete('cascade');
        $table->integer('nilai_target'); // Target angka 1-5 yang dicari perusahaan
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_target_lowongans');
    }
};
