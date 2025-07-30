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
        Schema::create('lowongan_keahlian_dibutuhkan', function (Blueprint $table) {
            $table->foreignId('lowongan_id')->constrained('lowongan_pekerjaan')->onDelete('cascade');
            $table->foreignId('keahlian_id')->constrained('keahlian')->onDelete('cascade');
            
            // Set primary key gabungan
            $table->primary(['lowongan_id', 'keahlian_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lowongan_keahlian_dibutuhkan');
    }
};