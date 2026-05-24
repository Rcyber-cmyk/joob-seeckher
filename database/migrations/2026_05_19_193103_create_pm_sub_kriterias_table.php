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
    Schema::create('pm_sub_kriteria', function (Blueprint $table) {
        $table->id();
        $table->foreignId('kriteria_id')->constrained('pm_kriteria')->onDelete('cascade');
        $table->string('nama_sub'); // Misal: "S1", "1-3 Tahun"
        $table->integer('nilai_profil'); // Skala 1-5
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_sub_kriterias');
    }
};
