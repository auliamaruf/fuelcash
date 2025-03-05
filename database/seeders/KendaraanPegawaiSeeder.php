<?php

namespace Database\Seeders;

use App\Models\KendaraanPegawai;
use App\Models\JenisKendaraan;
use Illuminate\Database\Seeder;

class KendaraanPegawaiSeeder extends Seeder
{
    public function run(): void
    {
        $mobil = JenisKendaraan::where('name', 'Mobil')->first();
        $motor = JenisKendaraan::where('name', 'Motor')->first();

        $vehicles = [
            [
                'id_jenis_kendaraan' => $mobil?->id,
                'nama_pemilik' => 'John Doe',
                'plat_nomor' => 'B 1234 ABC',
            ],
            [
                'id_jenis_kendaraan' => $motor?->id,
                'nama_pemilik' => 'Jane Doe',
                'plat_nomor' => 'B 5678 XYZ',
            ],
        ];

        foreach ($vehicles as $vehicle) {
            KendaraanPegawai::create($vehicle);
        }
    }
}
