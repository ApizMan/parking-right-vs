<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@parkingright.com',
            'password' => Hash::make('vista12345'), // Use a secure password
            'role' => 'admin', // Assuming there’s a role field to differentiate users
        ]);
    }
}
