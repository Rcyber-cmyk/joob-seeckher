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
        Schema::table('keahlian', function (Blueprint $table) {
            // Definisikan kolom dengan tipe data yang sama persis
            $table->unsignedBigInteger('bidang_keahlian_id')->nullable()->after('id');

            // Tambahkan foreign key constraint secara terpisah
            $table->foreign('bidang_keahlian_id')
                  ->references('id')
                  ->on('bidang_keahlians')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keahlian', function (Blueprint $table) {
            // Hapus constraint terlebih dahulu
            $table->dropForeign(['bidang_keahlian_id']);
            // Hapus kolomnya
            $table->dropColumn('bidang_keahlian_id');
        });
    }
};
