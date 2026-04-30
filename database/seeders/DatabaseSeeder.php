<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Donation;
use App\Models\BloodRequest;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // 1. CREATE YOUR ADMINS
        $admins = [
            ['name' => 'Qian Jedmarr Forro', 'email' => 'qianjedmarr@gmail.com', 'password' => 'Qian146230'],
            ['name' => 'Jhondhel Lauron', 'email' => 'jhondhel@gmail.com', 'password' => 'Jhondhel123'],
            ['name' => 'Shawn Harry Yuson', 'email' => 'shawnharry@gmail.com', 'password' => 'Shawnharry02'],
        ];

        foreach ($admins as $adminData) {
            User::create([
                'name' => $adminData['name'],
                'email' => $adminData['email'],
                'password' => Hash::make($adminData['password']),
                'role' => 'admin',
                'blood_type' => 'O+',
            ]);
        }

        // 2. GENERATE REGULAR USERS AND DONATIONS
        $bloodTypes = ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'];
        
        foreach ($bloodTypes as $type) {
            $user = User::factory()->create([
                'role' => 'user',
                'blood_type' => $type,
                'password' => Hash::make('password123'),
            ]);

            // Create a donation for this user
            // We must include 'name', 'dob', and 'email' because your migration requires them!
            Donation::create([
                'user_id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'dob' => now()->subYears(20)->format('Y-m-d'),
                'blood_type' => $type,
                'units' => rand(400, 500),
                'status' => 'approved',
                'created_at' => now()->subDays(rand(1, 20)),
            ]);
        }

        // 3. CREATE A SAMPLE REQUEST
        $donor = User::where('role', 'user')->first();
        BloodRequest::create([
            'user_id' => $donor->id,
            'patient_name' => 'Sample Patient',
            'hospital' => 'General Hospital',
            'blood_type' => 'O-',
            'units' => 450,
            'priority' => 'Urgent',
            'needed_by' => now()->addDays(2),
            'status' => 'pending',
        ]);
    }
}