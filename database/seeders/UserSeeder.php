<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usersData = [
            [
                'first_name' => 'Super',
                'middle_name' => 'Test',
                'last_name' => 'Admin',
                'email' => 'superadmin@gmail.com',
                'password' => Hash::make('admin'),
                'username' => 'superadmin',
                'phone_number' => '09650859745',
                'user_type_id' => 1,
                'address' => 'Davao City',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'first_name' => 'Parent',
                'middle_name' => 'Test',
                'last_name' => 'User',
                'email' => 'parent@gmail.com',
                'password' => Hash::make('parent'),
                'username' => 'parentuser',
                'phone_number' => '09650859741',
                'user_type_id' => 2,
                'address' => 'Davao City',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'first_name' => 'HealthCare',
                'middle_name' => 'Test',
                'last_name' => 'Provider',
                'email' => 'healthcareprovider@gmail.com',
                'password' => Hash::make('healthcareprovider'),
                'username' => 'healthcareprovider',
                'phone_number' => '09650859743',
                'user_type_id' => 3,
                'assigned_at' => 'Life & Care',  // PLACE DEFAILT ASSIGNMENT HERE
                'address' => 'Davao City',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        ];


        foreach ($usersData as $userData) {
            User::create($userData);
        }
    }
}
