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
        Schema::table('profiles_pelamar', function (Blueprint $table) {
            // Menambahkan kolom 'foto_profil' setelah kolom 'nama_lengkap'
            // Tipe datanya string untuk menyimpan path file, dan bisa null.
            $table->string('foto_profil')->nullable()->after('nama_lengkap');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles_pelamar', function (Blueprint $table) {
            // Menghapus kolom 'foto_profil' jika migrasi di-rollback
            $table->dropColumn('foto_profil');
        });
    }
};