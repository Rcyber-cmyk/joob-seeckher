<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Hapus kolom 'tempat_lahir' jika ada
        if (Schema::hasColumn('profiles_pelamar', 'tempat_lahir')) {
            Schema::table('profiles_pelamar', function (Blueprint $table) {
                $table->dropColumn('tempat_lahir');
            });
        }

        // Tambahkan kolom 'pengalaman_kerja' jika belum ada
        if (!Schema::hasColumn('profiles_pelamar', 'pengalaman_kerja')) {
            Schema::table('profiles_pelamar', function (Blueprint $table) {
                $table->string('pengalaman_kerja')->after('tahun_lulus')->nullable();
            });
        }
    }

    public function down(): void
    {
        // Kembalikan kolom 'tempat_lahir' jika belum ada
        if (!Schema::hasColumn('profiles_pelamar', 'tempat_lahir')) {
            Schema::table('profiles_pelamar', function (Blueprint $table) {
                $table->string('tempat_lahir')->after('alamat')->nullable();
            });
        }

        // Hapus kolom 'pengalaman_kerja' jika ada
        if (Schema::hasColumn('profiles_pelamar', 'pengalaman_kerja')) {
            Schema::table('profiles_pelamar', function (Blueprint $table) {
                $table->dropColumn('pengalaman_kerja');
            });
        }
    }
};

