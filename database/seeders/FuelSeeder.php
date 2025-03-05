<?php

namespace Database\Seeders;

use App\Models\Fuel;
use App\Models\MasterFuel;
use Illuminate\Database\Seeder;

class FuelSeeder extends Seeder
{
    public function run()
    {
        // Get master fuels
        $premium = MasterFuel::where('name', 'Premium')->first();
        $solar = MasterFuel::where('name', 'Solar')->first();

        // Create Premium category fuels
        Fuel::create([
            'id_master_fuel' => $premium->uuid,
            'name' => 'Pertalite',
            'code' => 'PLT',
            'desc' => 'Bahan bakar Pertalite',
            'price' => 10000,
            'is_active' => true
        ]);

        Fuel::create([
            'id_master_fuel' => $premium->uuid,
            'name' => 'Pertamax',
            'code' => 'PTX',
            'desc' => 'Bahan bakar Pertamax',
            'price' => 12500,
            'is_active' => true
        ]);

        // Create Solar category fuels
        Fuel::create([
            'id_master_fuel' => $solar->uuid,
            'name' => 'Dexlite',
            'code' => 'DXL',
            'desc' => 'Bahan bakar Dexlite',
            'price' => 13000,
            'is_active' => true
        ]);

        Fuel::create([
            'id_master_fuel' => $solar->uuid,
            'name' => 'Biosolar',
            'code' => 'BSL',
            'desc' => 'Bahan bakar Biosolar',
            'price' => 11000,
            'is_active' => true
        ]);
    }
}
