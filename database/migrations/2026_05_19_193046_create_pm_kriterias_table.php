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
    Schema::create('pm_kriteria', function (Blueprint $table) {
        $table->id();
        $table->string('nama_kriteria');
        $table->enum('jenis_faktor', ['core', 'secondary']);
        $table->integer('persentase_faktor')->default(0); // Contoh: 60 atau 40
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_kriterias');
    }
};
