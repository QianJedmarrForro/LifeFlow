<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // CREATE ADMIN ACCESS ONLY
        $admins = [
            [
                'name' => 'System Admin 1',
                'email' => 'qianjedmarr@gmail.com',
                'password' => 'Qian146230',
                'address' => 'Admin Address 1',
                'phone' => '09170000001',
                'profile_photo' => null,
            ],
            [
                'name' => 'System Admin 2',
                'email' => 'jhondhel@gmail.com',
                'password' => 'Jhondhel123',
                'address' => 'Admin Address 2',
                'phone' => '09170000002',
                'profile_photo' => null,
            ],
            [
                'name' => 'System Admin 3',
                'email' => 'shawnharry@gmail.com',
                'password' => 'Shawnharry02',
                'address' => 'Admin Address 3',
                'phone' => '09170000003',
                'profile_photo' => null,
            ],
        ];

        foreach ($admins as $adminData) {
            User::create([
                'name' => $adminData['name'],
                'email' => $adminData['email'],
                'password' => Hash::make($adminData['password']),
                'role' => 'admin',
                'blood_type' => 'O+', // Default blood type for admins
                'address' => $adminData['address'],
                'phone' => $adminData['phone'],
                'profile_photo' => $adminData['profile_photo'],
            ]);
        }
    }
}