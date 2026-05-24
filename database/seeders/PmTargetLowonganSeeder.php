<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\PmTargetLowongan;

class PmTargetLowonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        PmTargetLowongan::truncate();
        Schema::enableForeignKeyConstraints();

        // Ambil ID lowongan yang ada di database kamu (Contoh: ID 5, 8, 9)
        $lowonganIds = [5, 8, 9]; 

        foreach ($lowonganIds as $lowonganId) {
            $targets = [
                ['lowongan_id' => $lowonganId, 'kriteria_id' => 1, 'nilai_target' => 3], // Pendidikan (Target: S1)
                ['lowongan_id' => $lowonganId, 'kriteria_id' => 2, 'nilai_target' => 3], // Pengalaman (Target: 1-3 Tahun)
                ['lowongan_id' => $lowonganId, 'kriteria_id' => 3, 'nilai_target' => 4], // Nilai Akhir / IPK (Target: Baik)
                ['lowongan_id' => $lowonganId, 'kriteria_id' => 4, 'nilai_target' => 3], // Keahlian (Target: Cukup)
                ['lowongan_id' => $lowonganId, 'kriteria_id' => 5, 'nilai_target' => 5], // Usia (Target: Sesuai)
                ['lowongan_id' => $lowonganId, 'kriteria_id' => 6, 'nilai_target' => 5], // Domisili (Target: Satu Kota)
                ['lowongan_id' => $lowonganId, 'kriteria_id' => 7, 'nilai_target' => 5], // Gender (Target: Sesuai/Bebas)
            ];

            foreach ($targets as $target) {
                PmTargetLowongan::create($target);
            }
        }
    }
}