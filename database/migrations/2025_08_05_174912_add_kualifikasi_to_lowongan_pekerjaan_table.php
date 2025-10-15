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
        Schema::table('lowongan_pekerjaan', function (Blueprint $table) {
            $table->string('domisili')->nullable()->after('judul_lowongan');
            $table->string('tipe_pekerjaan')->nullable()->after('domisili'); // Contoh dari gambar
            $table->string('gender')->nullable()->after('deskripsi_pekerjaan');
            $table->string('pendidikan_terakhir')->nullable()->after('gender');
            $table->string('usia')->nullable()->after('pendidikan_terakhir');
            $table->string('nilai_pendidikan_terakhir')->nullable()->after('usia');
            $table->string('pengalaman_kerja')->nullable()->after('nilai_pendidikan_terakhir');
            $table->string('keahlian_bidang_pekerjaan')->nullable()->after('pengalaman_kerja');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongan_pekerjaan', function (Blueprint $table) {
            $table->dropColumn([
                'domisili',
                'tipe_pekerjaan',
                'gender',
                'pendidikan_terakhir',
                'usia',
                'nilai_pendidikan_terakhir',
                'pengalaman_kerja',
                'keahlian_bidang_pekerjaan'
            ]);
        });
    }
};
