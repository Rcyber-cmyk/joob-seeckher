<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BidangKeahlian;
use App\Models\Keahlian;

class BidangKeahlianSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            'Teknologi & Informasi' => [
                'HTML & CSS', 'JavaScript', 'PHP', 'Laravel', 'React.js', 'Vue.js', 'Node.js',
                'Python', 'Java', 'Go', 'Database (MySQL/PostgreSQL)', 'API Development',
                'UI/UX Design', 'Mobile Development (Android/iOS)', 'Cyber Security'
            ],
            'Pemasaran & Penjualan' => [
                'Digital Marketing', 'Social Media Marketing', 'SEO/SEM', 'Content Marketing',
                'Email Marketing', 'Sales & Negosiasi', 'Market Research', 'Branding',
                'Customer Relationship Management (CRM)', 'Copywriting'
            ],
            'Administrasi & Kantor' => [
                'Microsoft Office (Word, Excel, PowerPoint)', 'Google Workspace', 'Data Entry',
                'Manajemen Arsip', 'Pengetikan Cepat', 'Administrasi Perkantoran',
                'Customer Service', 'Manajemen Jadwal'
            ],
            'Desain & Kreatif' => [
                'Desain Grafis', 'Adobe Photoshop', 'Adobe Illustrator', 'Adobe Premiere Pro',
                'Videografi', 'Fotografi', 'Animasi', 'Content Creation'
            ],
            'Keuangan & Akuntansi' => [
                'Akuntansi Dasar', 'Perpajakan', 'Software Akuntansi (Accurate/Zahir)',
                'Analisis Keuangan', 'Manajemen Anggaran', 'Audit'
            ],
            'Manufaktur & Teknik' => [
                'Mesin Produksi', 'Otomotif', 'Kelistrikan', 'Quality Control',
                'Manajemen Gudang', 'K3 (Keselamatan dan Kesehatan Kerja)'
            ],
        ];

        foreach ($data as $namaBidang => $keahlians) {
            $bidang = BidangKeahlian::create(['nama_bidang' => $namaBidang]);

            foreach ($keahlians as $namaKeahlian) {
                Keahlian::create([
                    'bidang_keahlian_id' => $bidang->id,
                    'nama_keahlian' => $namaKeahlian,
                ]);
            }
        }
    }
}