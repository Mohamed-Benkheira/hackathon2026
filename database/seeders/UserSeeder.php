<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::create([
            'name' => 'Admin CFPA',
            'email' => 'admin@cfpa.dz',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Teacher user
        User::create([
            'name' => 'Mohamed Benali',
            'email' => 'teacher@cfpa.dz',
            'password' => Hash::make('password'),
            'role' => 'teacher',
        ]);

        // Student user
        User::create([
            'name' => 'Ahmed Bouzid',
            'email' => 'student@cfpa.dz',
            'password' => Hash::make('password'),
            'role' => 'student',
        ]);
    }
}
