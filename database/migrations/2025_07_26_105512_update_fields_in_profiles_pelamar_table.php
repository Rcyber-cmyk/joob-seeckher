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
            // 1. Hapus kolom 'tempat_lahir'
            $table->dropColumn('tempat_lahir');

            // 2. Tambahkan kolom 'pengalaman_kerja' setelah 'tahun_lulus'
            $table->string('pengalaman_kerja')->after('tahun_lulus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles_pelamar', function (Blueprint $table) {
            // Mengembalikan kolom jika migrasi di-rollback
            $table->string('tempat_lahir')->after('alamat')->nullable();
            $table->dropColumn('pengalaman_kerja');
        });
    }
};
