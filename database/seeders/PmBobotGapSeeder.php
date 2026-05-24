<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PmBobotGap; // Pastikan memanggil modelnya

class PmBobotGapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Kosongkan tabel dulu agar tidak duplikat jika dijalankan berulang
        PmBobotGap::truncate();

        // Aturan baku pembobotan nilai GAP pada Profile Matching
        $data = [
            ['selisih_gap' => 0,  'bobot_nilai' => 5.0, 'keterangan' => 'Tidak ada selisih (Kompetensi sesuai dengan kebutuhan)'],
            ['selisih_gap' => 1,  'bobot_nilai' => 4.5, 'keterangan' => 'Kompetensi individu kelebihan 1 tingkat'],
            ['selisih_gap' => -1, 'bobot_nilai' => 4.0, 'keterangan' => 'Kompetensi individu kekurangan 1 tingkat'],
            ['selisih_gap' => 2,  'bobot_nilai' => 3.5, 'keterangan' => 'Kompetensi individu kelebihan 2 tingkat'],
            ['selisih_gap' => -2, 'bobot_nilai' => 3.0, 'keterangan' => 'Kompetensi individu kekurangan 2 tingkat'],
            ['selisih_gap' => 3,  'bobot_nilai' => 2.5, 'keterangan' => 'Kompetensi individu kelebihan 3 tingkat'],
            ['selisih_gap' => -3, 'bobot_nilai' => 2.0, 'keterangan' => 'Kompetensi individu kekurangan 3 tingkat'],
            ['selisih_gap' => 4,  'bobot_nilai' => 1.5, 'keterangan' => 'Kompetensi individu kelebihan 4 tingkat'],
            ['selisih_gap' => -4, 'bobot_nilai' => 1.0, 'keterangan' => 'Kompetensi individu kekurangan 4 tingkat'],
        ];

        foreach ($data as $item) {
            PmBobotGap::create($item);
        }
    }
}