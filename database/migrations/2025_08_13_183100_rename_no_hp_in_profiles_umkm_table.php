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
            Schema::table('profiles_umkm', function (Blueprint $table) {
                // Mengubah nama kolom 'no_hp' menjadi 'no_hp_umkm'
                $table->renameColumn('no_hp', 'no_hp_umkm');
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::table('profiles_umkm', function (Blueprint $table) {
                // Mengembalikan nama kolom ke 'no_hp' jika migrasi dibatalkan
                $table->renameColumn('no_hp_umkm', 'no_hp');
            });
        }
    };
    