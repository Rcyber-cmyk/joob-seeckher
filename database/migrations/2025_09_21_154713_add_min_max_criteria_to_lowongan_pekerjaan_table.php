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
                // Tambahkan kolom usia_min setelah kolom usia (yang akan jadi usia_maks)
                $table->unsignedTinyInteger('usia_min')->default(0)->after('usia');
                // Tambahkan kolom pengalaman_kerja_maks setelah kolom pengalaman_kerja (yang akan jadi min)
                $table->unsignedTinyInteger('pengalaman_kerja_maks')->default(0)->after('pengalaman_kerja');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('lowongan_pekerjaan', function (Blueprint $table) {
                $table->dropColumn(['usia_min', 'pengalaman_kerja_maks']);
            });
        }
};
