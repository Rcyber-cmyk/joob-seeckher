<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::first();
        if (!$user) {
            $this->command->info('Silakan buat user terlebih dahulu sebelum menjalankan seeder produk.');
            return;
        }

        Product::truncate(); // Hapus data lama agar tidak duplikat

        $products = [
            ['name' => 'iPhone 15 Pro 256GB', 'description' => 'Kondisi mulus, garansi resmi masih panjang.', 'price' => 17500000, 'location' => 'Jakarta Pusat', 'condition' => 'Bekas', 'user_id' => $user->id],
            ['name' => 'Sony WH-1000XM5 Headphone', 'description' => 'Noise cancelling terbaik, suara jernih.', 'price' => 4200000, 'location' => 'Surabaya', 'condition' => 'Baru', 'user_id' => $user->id],
            ['name' => 'MacBook Air M2 8GB/256GB', 'description' => 'Lengkap dengan dus dan charger original.', 'price' => 15000000, 'location' => 'Bandung', 'condition' => 'Bekas', 'user_id' => $user->id],
            ['name' => 'Sepatu Lari Nike Pegasus 40', 'description' => 'Ukuran 42, original. Baru dipakai 2 kali.', 'price' => 1100000, 'location' => 'Yogyakarta', 'condition' => 'Bekas', 'user_id' => $user->id],
            ['name' => 'PlayStation 5 Disc Version', 'description' => 'Konsol PS5 lengkap dengan 1 stik DualSense.', 'price' => 7800000, 'location' => 'Medan', 'condition' => 'Bekas', 'user_id' => $user->id],
            ['name' => 'Kamera FujiFilm X-T30 II Kit', 'description' => 'Lengkap dengan lensa kit 15-45mm, SC rendah.', 'price' => 13500000, 'location' => 'Bali', 'condition' => 'Bekas', 'user_id' => $user->id],
            ['name' => 'Jam Tangan G-Shock GA-2100', 'description' => 'Original, tahan air, warna hitam. Kondisi baru.', 'price' => 1600000, 'location' => 'Makassar', 'condition' => 'Baru', 'user_id' => $user->id],
            ['name' => 'Nespresso Essenza Mini', 'description' => 'Mesin kopi kapsul, hemat tempat dan listrik.', 'price' => 1900000, 'location' => 'Semarang', 'condition' => 'Baru', 'user_id' => $user->id],
            ['name' => 'Monitor Gaming LG 27GP850', 'description' => '27 inch, 144Hz, QHD. Tidak ada dead pixel.', 'price' => 4500000, 'location' => 'Tangerang', 'condition' => 'Bekas', 'user_id' => $user->id],
            ['name' => 'Tas Ransel Eiger 25L', 'description' => 'Cocok untuk kegiatan sehari-hari atau hiking ringan.', 'price' => 450000, 'location' => 'Bogor', 'condition' => 'Baru', 'user_id' => $user->id],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}