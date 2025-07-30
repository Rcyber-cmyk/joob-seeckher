<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
public function up(): void
{
    Schema::create('users', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // Breeze butuh ini, bisa diisi nama lengkap/perusahaan
        $table->string('email')->unique();
        $table->timestamp('email_verified_at')->nullable();
        $table->string('password');
        $table->enum('role', ['admin', 'pelamar', 'perusahaan']); // KOLOM KUNCI
        $table->rememberToken();
        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
