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
    Schema::create('pm_bobot_gap', function (Blueprint $table) {
        $table->id();
        $table->decimal('selisih_gap', 5, 1); // Mendukung angka minus seperti -1, -1.5, dll
        $table->decimal('bobot_nilai', 5, 2); // Nilai pembobotan (5, 4.5, 4, dst)
        $table->string('keterangan')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pm_bobot_gaps');
    }
};
