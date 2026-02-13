<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Institute::all() as $institute) {
            // Generate 20 teachers per institute
            for ($i = 0; $i < 20; $i++) {
                $firstName = fake('ar_SA')->firstName(); // Arabic/local names
                $lastName = fake('ar_SA')->lastName();

                Teacher::create([
                    'institute_id' => $institute->id,
                    'first_name_ar' => $firstName,
                    'last_name_ar' => $lastName,
                    'first_name_fr' => fake('fr_FR')->firstName(),
                    'last_name_fr' => fake('fr_FR')->lastName(),
                    // Unique email using uuid to be safe
                    'email' => fake()->unique()->userName() . $institute->id . '@cfpa.dz',
                    'phone' => '0' . fake()->numberBetween(550000000, 799999999),
                    'status' => 'active',
                ]);
            }
        }
    }
}
