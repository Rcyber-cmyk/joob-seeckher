<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pelamar_id')->constrained('profiles_pelamar')->onDelete('cascade');
            $table->foreignId('lowongan_id')->constrained('lowongan_pekerjaan')->onDelete('cascade');
            $table->enum('status', ['pending', 'dilihat', 'diterima', 'ditolak'])->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lamaran');
    }
};