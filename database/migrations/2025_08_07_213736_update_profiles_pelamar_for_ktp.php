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
            // Hapus kolom lama
            if (Schema::hasColumn('profiles_pelamar', 'file_cv')) {
                $table->dropColumn('file_cv');
            }
            // Tambahkan kolom baru
            $table->string('foto_ktp')->nullable()->after('tentang_saya');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles_pelamar', function (Blueprint $table) {
            // Hapus kolom baru
            $table->dropColumn('foto_ktp');
            // Tambahkan kembali kolom lama
            $table->string('file_cv')->nullable()->after('tentang_saya');
        });
    }
};