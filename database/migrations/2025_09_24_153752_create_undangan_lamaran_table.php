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
            Schema::create('undangan_lamaran', function (Blueprint $table) {
                $table->id();
                $table->foreignId('perusahaan_id')->constrained('profiles_perusahaan')->onDelete('cascade');
                $table->foreignId('pelamar_id')->constrained('profile_pelamar')->onDelete('cascade');
                $table->foreignId('lowongan_id')->constrained('lowongan_pekerjaan')->onDelete('cascade');
                $table->enum('status', ['terkirim', 'dilihat', 'diterima', 'ditolak'])->default('terkirim');
                $table->text('pesan')->nullable();
                $table->timestamps();

                // Mencegah undangan duplikat untuk pelamar dan lowongan yang sama
                $table->unique(['pelamar_id', 'lowongan_id']);
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('undangan_lamaran');
        }
};
