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
            // 1. Hapus kolom 'tempat_lahir' jika ada
            if (Schema::hasColumn('profiles_pelamar', 'tempat_lahir')) {
                $table->dropColumn('tempat_lahir');
            }

            // 2. Tambahkan kolom 'pengalaman_kerja' jika belum ada
            if (!Schema::hasColumn('profiles_pelamar', 'pengalaman_kerja')) {
                $table->string('pengalaman_kerja')->after('tahun_lulus')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles_pelamar', function (Blueprint $table) {
            // Tambahkan kembali 'tempat_lahir' jika belum ada
            if (!Schema::hasColumn('profiles_pelamar', 'tempat_lahir')) {
                $table->string('tempat_lahir')->after('alamat')->nullable();
            }

            // Hapus 'pengalaman_kerja' jika ada
            if (Schema::hasColumn('profiles_pelamar', 'pengalaman_kerja')) {
                $table->dropColumn('pengalaman_kerja');
            }
        });
    }
};
