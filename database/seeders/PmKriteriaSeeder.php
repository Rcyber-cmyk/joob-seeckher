<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; // <-- Jangan lupa tambahkan ini
use App\Models\PmKriteria;

class PmKriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Matikan sementara pengecekan Foreign Key
        Schema::disableForeignKeyConstraints();

        // 2. Sekarang aman untuk di-truncate
        PmKriteria::truncate();

        // 3. Nyalakan kembali pengecekan Foreign Key
        Schema::enableForeignKeyConstraints();

        $kriteria = [
            // CORE FACTORS (60%)
            ['nama_kriteria' => 'Pendidikan Terakhir', 'jenis_faktor' => 'core', 'persentase_faktor' => 60],
            ['nama_kriteria' => 'Pengalaman Kerja', 'jenis_faktor' => 'core', 'persentase_faktor' => 60],
            ['nama_kriteria' => 'Nilai Akhir Pendidikan', 'jenis_faktor' => 'core', 'persentase_faktor' => 60],
            ['nama_kriteria' => 'Keahlian', 'jenis_faktor' => 'core', 'persentase_faktor' => 60],
            
            // SECONDARY FACTORS (40%)
            ['nama_kriteria' => 'Usia', 'jenis_faktor' => 'secondary', 'persentase_faktor' => 40],
            ['nama_kriteria' => 'Domisili', 'jenis_faktor' => 'secondary', 'persentase_faktor' => 40],
            ['nama_kriteria' => 'Gender', 'jenis_faktor' => 'secondary', 'persentase_faktor' => 40],
        ];

        foreach ($kriteria as $item) {
            PmKriteria::create($item);
        }
    }
}