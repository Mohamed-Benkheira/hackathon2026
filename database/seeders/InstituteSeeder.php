<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InstituteSeeder extends Seeder
{
    public function run(): void
    {
        $institutes = [
            'CFPA Alger Centre',
            'Institut de Formation Blida',
            'Centre de Formation Oran',
            'Institut National de Constantine', // New
            'CFPA Annaba Sud',                // New
            'INSFP Setif',                    // New
        ];

        foreach ($institutes as $name) {
            Institute::firstOrCreate(['name' => $name]);
        }

        // Ministry super-admin
        User::firstOrCreate(
            ['email' => 'ministry@cfpa.dz'],
            [
                'name' => 'Ministry Admin',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'institute_id' => null,
            ]
        );

        // Institute admins
        foreach (Institute::all() as $index => $institute) {
            User::firstOrCreate(
                ['email' => 'admin' . ($index + 1) . '@cfpa.dz'],
                [
                    'name' => 'Admin ' . $institute->name,
                    'password' => Hash::make('password'),
                    'role' => 'admin',
                    'institute_id' => $institute->id,
                ]
            );
        }
    }
}
