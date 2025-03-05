<?php

namespace Database\Seeders;

use App\Models\JenisKendaraan;
use Illuminate\Database\Seeder;

class JenisKendaraanSeeder extends Seeder
{
    public function run(): void
    {
        $types = [
            [
                'name' => 'Mobil',
                'desc' => 'Kendaraan roda empat untuk penggunaan umum'
            ],
            [
                'name' => 'Motor',
                'desc' => 'Kendaraan roda dua'
            ],
            [
                'name' => 'Truk',
                'desc' => 'Kendaraan angkutan berat'
            ],
            [
                'name' => 'Bus',
                'desc' => 'Kendaraan angkutan penumpang'
            ],
        ];

        foreach ($types as $type) {
            JenisKendaraan::create($type);
        }
    }
}
