<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InstituteSeeder extends Seeder
{
    public function run(): void
    {
        // 5 institutes
        $institutes = Institute::factory(5)->create([
            'name' => fn() => fake()->randomElement([
                'Institut Technique de Tizi Ouzou',
                'CFPA d\'Alger Centre',
                'Centre de Formation de Blida',
                'Institut Professionnel de Oran',
                'Ecole Supérieure de Constantine',
            ])
        ]);

        // Ministry super-admin (sees ALL data)
        User::create([
            'name' => 'Ministry Admin',
            'email' => 'ministry@cfpa.dz',
            'password' => Hash::make('password'),
            'role' => 'super_admin', // sees everything
            'institute_id' => null,
        ]);

        // Institute admins (scoped to their institute)
        foreach ($institutes as $institute) {
            User::create([
                'name' => 'Admin ' . $institute->name,
                'email' => 'admin@' . strtolower($institute->name) . '.dz',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'institute_id' => $institute->id,
            ]);
        }
    }
}
