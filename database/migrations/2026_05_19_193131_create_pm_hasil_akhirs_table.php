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
    Schema::create('pm_hasil_akhir', function (Blueprint $table) {
        $table->id();
        $table->foreignId('lamaran_id')->constrained('lamaran')->onDelete('cascade');
        $table->decimal('skor_core', 8, 2)->default(0);
        $table->decimal('skor_secondary', 8, 2)->default(0);
        $table->decimal('skor_total', 8, 2)->default(0); // Penentu ranking
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_hasil_akhirs');
    }
};
