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
        Schema::create('profiles_umkm', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('nama_usaha');
            $table->string('nama_pemilik');
            $table->text('alamat_usaha');
            $table->string('kota');
            $table->string('no_hp'); // Nomor HP / WhatsApp
            $table->string('kategori_usaha'); // Contoh: Kuliner, Fashion, Jasa, dll.
            $table->text('deskripsi_usaha')->nullable();
            $table->string('situs_web_atau_medsos')->nullable(); // Bisa diisi link website, Instagram, Facebook, dll.
            $table->string('logo_usaha')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles_umkm');
    }
};