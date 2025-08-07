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
        Schema::table('profiles_perusahaan', function (Blueprint $table) {
            // Hapus kolom lama jika Anda setuju dengan rekomendasi ini
            if (Schema::hasColumn('profiles_perusahaan', 'alamat_perusahaan')) {
                $table->dropColumn('alamat_perusahaan');
            }

            // Tambahkan kolom baru yang lebih detail
            $table->text('alamat_jalan')->nullable()->after('nama_perusahaan');
            $table->string('alamat_kota')->nullable()->after('alamat_jalan');
            $table->string('kode_pos', 10)->nullable()->after('alamat_kota');
            $table->string('no_telp_perusahaan', 20)->nullable()->after('kode_pos');
            $table->string('npwp_perusahaan', 25)->nullable()->after('no_telp_perusahaan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles_perusahaan', function (Blueprint $table) {
            // Kembalikan kolom lama
            $table->string('alamat_perusahaan')->nullable();

            // Hapus kolom-kolom baru
            $table->dropColumn([
                'alamat_jalan',
                'alamat_kota',
                'kode_pos',
                'no_telp_perusahaan',
                'npwp_perusahaan'
            ]);
        });
    }
};