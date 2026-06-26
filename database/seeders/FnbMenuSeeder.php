<?php

namespace Database\Seeders;

use App\Models\FnbMenu;
use Illuminate\Database\Seeder;

class FnbMenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            // Food
            ['menu_name' => 'Nasi Goreng Glamping',   'category' => 'food',     'price' => 45000, 'description' => 'Nasi goreng spesial dengan telur dan kerupuk'],
            ['menu_name' => 'Ayam Bakar Madu',        'category' => 'food',     'price' => 55000, 'description' => 'Ayam bakar dengan saus madu premium'],
            ['menu_name' => 'Sate Lilit Bali',        'category' => 'food',     'price' => 50000, 'description' => 'Sate lilit ikan khas Bali'],
            ['menu_name' => 'Pasta Carbonara',        'category' => 'food',     'price' => 65000, 'description' => 'Pasta dengan saus krim dan bacon'],
            ['menu_name' => 'BBQ Platter',            'category' => 'food',     'price' => 120000, 'description' => 'Platter BBQ dengan daging sapi, ayam, dan sosis'],
            ['menu_name' => 'Mie Goreng Seafood',     'category' => 'food',     'price' => 48000, 'description' => 'Mie goreng dengan topping seafood'],

            // Beverages
            ['menu_name' => 'Es Kelapa Muda',         'category' => 'beverage', 'price' => 20000, 'description' => 'Kelapa muda segar'],
            ['menu_name' => 'Jus Alpukat',            'category' => 'beverage', 'price' => 25000, 'description' => 'Jus alpukat dengan susu coklat'],
            ['menu_name' => 'Kopi Tubruk',            'category' => 'beverage', 'price' => 18000, 'description' => 'Kopi lokal diseduh tradisional'],
            ['menu_name' => 'Lemon Ginger Tea',       'category' => 'beverage', 'price' => 22000, 'description' => 'Teh jahe lemon hangat'],
            ['menu_name' => 'Mocktail Sunset',        'category' => 'beverage', 'price' => 35000, 'description' => 'Campuran jus tropis menyegarkan'],

            // Snacks
            ['menu_name' => 'French Fries',           'category' => 'snack',    'price' => 30000, 'description' => 'Kentang goreng renyah dengan saus'],
            ['menu_name' => 'Pisang Goreng Keju',     'category' => 'snack',    'price' => 25000, 'description' => 'Pisang goreng crispy dengan taburan keju'],
            ['menu_name' => 'Marshmallow Kit',        'category' => 'snack',    'price' => 28000, 'description' => 'Kit marshmallow untuk campfire'],
            ['menu_name' => 'Roti Bakar Coklat',      'category' => 'snack',    'price' => 22000, 'description' => 'Roti bakar dengan selai coklat premium'],
        ];

        foreach ($menus as $menu) {
            FnbMenu::firstOrCreate(
                ['menu_name' => $menu['menu_name']],
                array_merge($menu, ['is_available' => true])
            );
        }
    }
}
