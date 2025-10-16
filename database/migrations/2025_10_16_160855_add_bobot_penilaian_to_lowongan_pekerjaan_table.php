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
            // Menambahkan kolom sesuai form di gambar Anda
            $table->unsignedTinyInteger('bobot_domisili')->default(0)->after('deskripsi');
            $table->unsignedTinyInteger('bobot_usia')->default(0)->after('bobot_domisili');
            $table->unsignedTinyInteger('bobot_gender')->default(0)->after('bobot_usia');
            $table->unsignedTinyInteger('bobot_pendidikan')->default(0)->after('bobot_gender');
            $table->unsignedTinyInteger('bobot_nilai_akhir')->default(0)->after('bobot_pendidikan');
            $table->unsignedTinyInteger('bobot_pengalaman_kerja')->default(0)->after('bobot_nilai_akhir');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongan_pekerjaan', function (Blueprint $table) {
            $table->dropColumn([
                'bobot_domisili',
                'bobot_usia',
                'bobot_gender',
                'bobot_pendidikan',
                'bobot_nilai_akhir',
                'bobot_pengalaman_kerja'
            ]);
        });
    }
};