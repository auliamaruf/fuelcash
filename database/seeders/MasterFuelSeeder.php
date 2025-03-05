<?php

namespace Database\Seeders;

use App\Models\MasterFuel;
use Illuminate\Database\Seeder;

class MasterFuelSeeder extends Seeder
{
    public function run()
    {
        MasterFuel::create([
            'name' => 'Premium',
            'code' => 'PRM',
            'desc' => 'Kategori bahan bakar Premium',
            'is_active' => true
        ]);

        MasterFuel::create([
            'name' => 'Solar',
            'code' => 'SOL',
            'desc' => 'Kategori bahan bakar Solar',
            'is_active' => true
        ]);
    }
}
