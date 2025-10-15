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
            $table->unsignedTinyInteger('bobot_domisili')->default(0)->after('keahlian_bidang_pekerjaan');
            $table->unsignedTinyInteger('bobot_usia')->default(0)->after('bobot_domisili');
            $table->unsignedTinyInteger('bobot_gender')->default(0)->after('bobot_usia');
            $table->unsignedTinyInteger('bobot_pendidikan')->default(0)->after('bobot_gender');
            $table->unsignedTinyInteger('bobot_nilai')->default(0)->after('bobot_pendidikan');
            $table->unsignedTinyInteger('bobot_pengalaman')->default(0)->after('bobot_nilai');
        });
    }

    public function down(): void
    {
        Schema::table('lowongan_pekerjaan', function (Blueprint $table) {
            $table->dropColumn([
                'bobot_domisili', 'bobot_usia', 'bobot_gender', 
                'bobot_pendidikan', 'bobot_nilai', 'bobot_pengalaman', 'bobot_keahlian'
            ]);
        });
    }
};
