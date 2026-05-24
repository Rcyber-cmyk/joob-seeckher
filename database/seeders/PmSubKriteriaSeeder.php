<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use App\Models\PmSubKriteria;

class PmSubKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Matikan sementara pengecekan Foreign Key untuk proses truncate
        Schema::disableForeignKeyConstraints();
        PmSubKriteria::truncate();
        Schema::enableForeignKeyConstraints();

        $subKriteria = [
            // 1. Pendidikan Terakhir (Kriteria ID: 1)
            ['kriteria_id' => 1, 'nama_sub' => 'SMA/SMK Sederajat', 'nilai_profil' => 1],
            ['kriteria_id' => 1, 'nama_sub' => 'D1/D2/D3', 'nilai_profil' => 2],
            ['kriteria_id' => 1, 'nama_sub' => 'S1', 'nilai_profil' => 3],
            ['kriteria_id' => 1, 'nama_sub' => 'S2', 'nilai_profil' => 4],
            ['kriteria_id' => 1, 'nama_sub' => 'S3', 'nilai_profil' => 5],

            // 2. Pengalaman Kerja (Kriteria ID: 2)
            ['kriteria_id' => 2, 'nama_sub' => 'Fresh Graduate', 'nilai_profil' => 1],
            ['kriteria_id' => 2, 'nama_sub' => '< 1 Tahun', 'nilai_profil' => 2],
            ['kriteria_id' => 2, 'nama_sub' => '1-3 Tahun', 'nilai_profil' => 3],
            ['kriteria_id' => 2, 'nama_sub' => '3-5 Tahun', 'nilai_profil' => 4],
            ['kriteria_id' => 2, 'nama_sub' => '> 5 Tahun', 'nilai_profil' => 5],

            // 3. Nilai Akhir / IPK (Kriteria ID: 3)
            ['kriteria_id' => 3, 'nama_sub' => '< 70 atau IPK < 2.75', 'nilai_profil' => 1],
            ['kriteria_id' => 3, 'nama_sub' => '70 - 75 atau IPK 2.75 - 2.99', 'nilai_profil' => 2],
            ['kriteria_id' => 3, 'nama_sub' => '76 - 85 atau IPK 3.00 - 3.49', 'nilai_profil' => 3],
            ['kriteria_id' => 3, 'nama_sub' => '86 - 90 atau IPK 3.50 - 3.74', 'nilai_profil' => 4],
            ['kriteria_id' => 3, 'nama_sub' => '> 90 atau IPK 3.75 - 4.00', 'nilai_profil' => 5],

            // 4. Keahlian (Kriteria ID: 4)
            ['kriteria_id' => 4, 'nama_sub' => 'Match 0% - 20%', 'nilai_profil' => 1],
            ['kriteria_id' => 4, 'nama_sub' => 'Match 21% - 40%', 'nilai_profil' => 2],
            ['kriteria_id' => 4, 'nama_sub' => 'Match 41% - 60%', 'nilai_profil' => 3],
            ['kriteria_id' => 4, 'nama_sub' => 'Match 61% - 80%', 'nilai_profil' => 4],
            ['kriteria_id' => 4, 'nama_sub' => 'Match 81% - 100%', 'nilai_profil' => 5],

            // 5. Usia (Kriteria ID: 5)
            ['kriteria_id' => 5, 'nama_sub' => 'Lebih tua > 5 tahun dari target', 'nilai_profil' => 1],
            ['kriteria_id' => 5, 'nama_sub' => 'Lebih tua 3-5 tahun dari target', 'nilai_profil' => 2],
            ['kriteria_id' => 5, 'nama_sub' => 'Lebih tua 1-2 tahun dari target', 'nilai_profil' => 3],
            ['kriteria_id' => 5, 'nama_sub' => 'Lebih muda > 5 tahun dari target', 'nilai_profil' => 4],
            ['kriteria_id' => 5, 'nama_sub' => 'Sesuai target atau lebih muda 0-4 tahun', 'nilai_profil' => 5],

            // 6. Domisili (Kriteria ID: 6)
            ['kriteria_id' => 6, 'nama_sub' => 'Berbeda Provinsi', 'nilai_profil' => 1],
            ['kriteria_id' => 6, 'nama_sub' => 'Satu Provinsi (Beda Kota)', 'nilai_profil' => 3],
            ['kriteria_id' => 6, 'nama_sub' => 'Satu Kota', 'nilai_profil' => 5],

            // 7. Gender (Kriteria ID: 7)
            ['kriteria_id' => 7, 'nama_sub' => 'Tidak Sesuai Target', 'nilai_profil' => 1],
            ['kriteria_id' => 7, 'nama_sub' => 'Sesuai Target / Bebas', 'nilai_profil' => 5],
        ];

        foreach ($subKriteria as $item) {
            PmSubKriteria::create($item);
        }
    }
}