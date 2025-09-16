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
            // Tambahkan kolom baru setelah kolom 'tahun_lulus'
            // Menggunakan decimal untuk presisi IPK (misal: 3.75)
            $table->decimal('nilai_akhir', 5, 2)->nullable()->after('tahun_lulus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles_pelamar', function (Blueprint $table) {
            $table->dropColumn('nilai_akhir');
        });
    }
};