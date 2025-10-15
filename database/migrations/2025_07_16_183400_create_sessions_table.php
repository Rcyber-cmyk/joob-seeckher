<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Menjalankan migrasi.
     */
    public function up(): void
    {
        Schema::create('sessions', function (Blueprint $table) {
            // ID unik untuk setiap sesi yang aktif
            $table->string('id')->primary();

            // Kunci penghubung ke tabel 'users', bisa kosong jika pengunjung adalah tamu (belum login)
            $table->foreignId('user_id')->nullable()->index();

            // Informasi teknis tentang sesi
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            // Data utama sesi (disimpan dalam bentuk terenkripsi)
            $table->longText('payload');

            // Timestamp aktivitas terakhir untuk menentukan kapan sesi dianggap kedaluwarsa
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Membatalkan migrasi.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};