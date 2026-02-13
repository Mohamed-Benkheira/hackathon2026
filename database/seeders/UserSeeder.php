<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Extra institute users
        \App\Models\Institute::all()->each(function ($institute) {
            User::factory(2)->create([
                'institute_id' => $institute->id,
                'role' => fake()->randomElement(['teacher', 'student']),
            ]);
        });
    }
}
