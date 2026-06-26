<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['name' => 'Budi Santoso',      'email' => 'budi@email.com',       'phone' => '081234567890', 'alamat' => 'Jakarta Selatan',    'total_visits' => 6, 'customer_segment' => 'vip'],
            ['name' => 'Sari Dewi',         'email' => 'sari@email.com',       'phone' => '081234567891', 'alamat' => 'Bandung',            'total_visits' => 5, 'customer_segment' => 'vip'],
            ['name' => 'Agus Pratama',      'email' => 'agus@email.com',       'phone' => '081234567892', 'alamat' => 'Surabaya',           'total_visits' => 3, 'customer_segment' => 'returning'],
            ['name' => 'Rina Putri',        'email' => 'rina@email.com',       'phone' => '081234567893', 'alamat' => 'Denpasar',           'total_visits' => 4, 'customer_segment' => 'returning'],
            ['name' => 'Dewa Putra',        'email' => 'dewa@email.com',       'phone' => '081234567894', 'alamat' => 'Ubud, Bali',         'total_visits' => 2, 'customer_segment' => 'returning'],
            ['name' => 'Laksmi Ayu',        'email' => 'laksmi@email.com',     'phone' => '081234567895', 'alamat' => 'Tabanan, Bali',      'total_visits' => 1, 'customer_segment' => 'new'],
            ['name' => 'Made Wirawan',      'email' => 'made@email.com',       'phone' => '081234567896', 'alamat' => 'Gianyar, Bali',      'total_visits' => 7, 'customer_segment' => 'vip'],
            ['name' => 'Kadek Sari',        'email' => 'kadek@email.com',      'phone' => '081234567897', 'alamat' => 'Singaraja',          'total_visits' => 1, 'customer_segment' => 'new'],
            ['name' => 'Wayan Arta',        'email' => 'wayan@email.com',      'phone' => '081234567898', 'alamat' => 'Kuta, Bali',         'total_visits' => 3, 'customer_segment' => 'returning'],
            ['name' => 'Putu Rahma',        'email' => 'putu@email.com',       'phone' => '081234567899', 'alamat' => 'Seminyak, Bali',     'total_visits' => 0, 'customer_segment' => 'new'],
            ['name' => 'Nyoman Jaya',       'email' => 'nyoman@email.com',     'phone' => '081234567800', 'alamat' => 'Klungkung, Bali',    'total_visits' => 2, 'customer_segment' => 'returning'],
            ['name' => 'Komang Dewi',       'email' => 'komang@email.com',     'phone' => '081234567801', 'alamat' => 'Karangasem, Bali',   'total_visits' => 1, 'customer_segment' => 'new'],
            ['name' => 'Ketut Mandra',      'email' => 'ketut@email.com',      'phone' => '081234567802', 'alamat' => 'Bangli, Bali',       'total_visits' => 0, 'customer_segment' => 'new'],
            ['name' => 'Indra Kurniawan',   'email' => 'indra@email.com',      'phone' => '081234567803', 'alamat' => 'Yogyakarta',         'total_visits' => 5, 'customer_segment' => 'vip'],
            ['name' => 'Sri Lestari',       'email' => 'sri@email.com',        'phone' => '081234567804', 'alamat' => 'Semarang',           'total_visits' => 1, 'customer_segment' => 'new'],
            ['name' => 'Bambang Setiawan',  'email' => 'bambang@email.com',    'phone' => '081234567805', 'alamat' => 'Malang',             'total_visits' => 3, 'customer_segment' => 'returning'],
            ['name' => 'Ayu Lestari',       'email' => 'ayu@email.com',        'phone' => '081234567806', 'alamat' => 'Jakarta Pusat',      'total_visits' => 2, 'customer_segment' => 'returning'],
            ['name' => 'Gede Wirawan',      'email' => 'gede@email.com',       'phone' => '081234567807', 'alamat' => 'Jembrana, Bali',     'total_visits' => 0, 'customer_segment' => 'new'],
            ['name' => 'Ni Luh Putu',       'email' => 'niluh@email.com',      'phone' => '081234567808', 'alamat' => 'Sanur, Bali',        'total_visits' => 4, 'customer_segment' => 'returning'],
            ['name' => 'Cokorda Bagus',     'email' => 'cokorda@email.com',    'phone' => '081234567809', 'alamat' => 'Nusa Dua, Bali',     'total_visits' => 8, 'customer_segment' => 'vip'],
        ];

        foreach ($customers as $customer) {
            Customer::firstOrCreate(
                ['email' => $customer['email']],
                $customer
            );
        }
    }
}
