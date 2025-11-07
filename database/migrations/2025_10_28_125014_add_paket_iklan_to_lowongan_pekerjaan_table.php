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
            // Tambahkan kolom baru 'paket_iklan'
            // Tipe datanya string, bisa null, defaultnya 'standar'
            // Letakkan setelah kolom 'keahlian_bidang_pekerjaan' (sesuaikan jika perlu)
            $table->string('paket_iklan')->nullable()->default('standar')->after('keahlian_bidang_pekerjaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lowongan_pekerjaan', function (Blueprint $table) {
            // Hapus kolom jika migrasi di-rollback
            $table->dropColumn('paket_iklan');
        });
    }
};