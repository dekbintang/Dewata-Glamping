<?php

namespace Database\Seeders;

use App\Models\UnitGlamping;
use Illuminate\Database\Seeder;

class UnitGlampingSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['unit_name' => 'Tent A1',  'unit_type' => 'tent',      'price_per_night' => 350000, 'capacity' => 2, 'description' => 'Tenda premium dengan view pegunungan'],
            ['unit_name' => 'Tent A2',  'unit_type' => 'tent',      'price_per_night' => 350000, 'capacity' => 2, 'description' => 'Tenda premium dengan view danau'],
            ['unit_name' => 'Cabin B1', 'unit_type' => 'cabin',     'price_per_night' => 550000, 'capacity' => 4, 'description' => 'Kabin kayu dengan fasilitas lengkap'],
            ['unit_name' => 'Cabin B2', 'unit_type' => 'cabin',     'price_per_night' => 550000, 'capacity' => 4, 'description' => 'Kabin kayu di tepi sungai'],
            ['unit_name' => 'Cabin B3', 'unit_type' => 'cabin',     'price_per_night' => 550000, 'capacity' => 3, 'description' => 'Kabin kayu cozy untuk pasangan'],
            ['unit_name' => 'Dome C1',  'unit_type' => 'dome',      'price_per_night' => 750000, 'capacity' => 2, 'description' => 'Dome transparan untuk stargazing'],
            ['unit_name' => 'Dome C2',  'unit_type' => 'dome',      'price_per_night' => 750000, 'capacity' => 3, 'description' => 'Dome premium dengan jacuzzi outdoor'],
            ['unit_name' => 'Dome C3',  'unit_type' => 'dome',      'price_per_night' => 750000, 'capacity' => 2, 'description' => 'Dome garden dengan taman privat'],
            ['unit_name' => 'Tree D1',  'unit_type' => 'treehouse', 'price_per_night' => 950000, 'capacity' => 2, 'description' => 'Rumah pohon eksklusif dengan view 360°'],
            ['unit_name' => 'Tree D2',  'unit_type' => 'treehouse', 'price_per_night' => 950000, 'capacity' => 3, 'description' => 'Rumah pohon mewah dengan rooftop deck'],
        ];

        foreach ($units as $unit) {
            UnitGlamping::firstOrCreate(
                ['unit_name' => $unit['unit_name']],
                array_merge($unit, ['status' => 'available'])
            );
        }
    }
}
