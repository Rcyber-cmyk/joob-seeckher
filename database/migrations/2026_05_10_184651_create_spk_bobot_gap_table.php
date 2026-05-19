<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('spk_bobot_gap', function (Blueprint $table) {
            $table->id();
            $table->integer('selisih'); // Menyimpan nilai selisih (contoh: 0, 1, -1)
            $table->decimal('bobot', 3, 1); // Menyimpan nilai bobot (contoh: 5.0, 4.5)
            $table->string('keterangan'); // Penjelasan nilai gap
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spk_bobot_gap');
    }
};