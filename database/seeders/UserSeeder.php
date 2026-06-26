<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Admin GlampERP',    'email' => 'admin@glamperp.com',        'role' => 'admin'],
            ['name' => 'Front Office',      'email' => 'frontoffice@glamperp.com',  'role' => 'front_office'],
            ['name' => 'F&B Staff',         'email' => 'fnb@glamperp.com',          'role' => 'fnb_staff'],
            ['name' => 'Housekeeping',      'email' => 'housekeeping@glamperp.com', 'role' => 'housekeeping'],
            ['name' => 'Finance',           'email' => 'finance@glamperp.com',      'role' => 'finance'],
            ['name' => 'Customer Portal',   'email' => 'customer@glamperp.com',     'role' => 'customer'],
        ];

        foreach ($users as $userData) {
            $user = User::firstOrCreate(
                ['email' => $userData['email']],
                [
                    'name'      => $userData['name'],
                    'password'  => Hash::make('password'),
                    'role'      => $userData['role'],
                    'is_active' => true,
                ]
            );
            $user->assignRole($userData['role']);
        }
    }
}
