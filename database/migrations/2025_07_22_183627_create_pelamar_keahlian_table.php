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
        Schema::create('pelamar_keahlian', function (Blueprint $table) {
            $table->foreignId('pelamar_id')->constrained('profiles_pelamar')->onDelete('cascade');
            $table->foreignId('keahlian_id')->constrained('keahlian')->onDelete('cascade');
            
            // Set primary key gabungan untuk mencegah duplikat
            $table->primary(['pelamar_id', 'keahlian_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelamar_keahlian');
    }
};