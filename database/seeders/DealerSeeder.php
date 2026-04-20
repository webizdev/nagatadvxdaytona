<?php

namespace Database\Seeders;

use App\Models\Dealer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DealerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dealers = [
            // Jakarta
            [
                'nama_toko' => 'Daytona Racing Jakarta',
                'alamat' => 'Jl. Kebon Jeruk III No. 15, RT.2/RW.4, Maphar, Kec. Taman Sari, Jakarta Barat',
                'kota' => 'Jakarta',
                'no_telp' => '021-12345678',
            ],
            [
                'nama_toko' => 'MotoX Speed Shop',
                'alamat' => 'Jl. Raya Fatmawati No. 45, Cilandak, Jakarta Selatan',
                'kota' => 'Jakarta',
                'no_telp' => '021-87654321',
            ],
            // Bandung
            [
                'nama_toko' => 'Bandung Moto Parts',
                'alamat' => 'Jl. Pungkur No. 120, Pungkur, Kec. Regol, Kota Bandung',
                'kota' => 'Bandung',
                'no_telp' => '022-77665544',
            ],
            [
                'nama_toko' => 'Jabar Racing Store',
                'alamat' => 'Jl. R.E. Martadinata (Riau) No. 99, Kota Bandung',
                'kota' => 'Bandung',
                'no_telp' => '022-11223344',
            ],
            // Surabaya
            [
                'nama_toko' => 'Surabaya Scooterist',
                'alamat' => 'Jl. Tidar No. 80, Sawahan, Kota Surabaya',
                'kota' => 'Surabaya',
                'no_telp' => '031-99887766',
            ],
            // Yogyakarta
            [
                'nama_toko' => 'Jogja Engine Builder',
                'alamat' => 'Jl. Magelang KM. 5, Sinduadi, Sleman, Yogyakarta',
                'kota' => 'Yogyakarta',
                'no_telp' => '0274-554321',
            ],
        ];

        foreach ($dealers as $dealer) {
            Dealer::create($dealer);
        }
    }
}
