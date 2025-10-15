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
    Schema::create('profiles_pelamar', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->string('nama_lengkap');
        $table->string('nik', 16)->unique();
        $table->text('alamat');
        $table->string('no_hp', 20);
        $table->date('tanggal_lahir');
        $table->enum('gender', ['Laki-laki', 'Perempuan']);
        $table->year('tahun_lulus');
        $table->string('file_cv')->nullable();
        $table->text('tentang_saya')->nullable();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles_pelamar');
    }
};
