<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Chunk groups to avoid memory issues if you have tons
        $groups = Group::all();

        foreach ($groups as $group) {
            // 25 students per group
            for ($i = 1; $i <= 25; $i++) {
                Student::create([
                    'institute_id' => $group->institute_id,
                    'group_id' => $group->id,
                    // Unique matricule: GroupID + Index
                    'matricule' => sprintf('%04d/%02d', $group->id, $i),
                    'first_name_ar' => fake('ar_SA')->firstName(),
                    'last_name_ar' => fake('ar_SA')->lastName(),
                    'first_name_fr' => fake('fr_FR')->firstName(),
                    'last_name_fr' => fake('fr_FR')->lastName(),
                    'email' => fake()->unique()->userName() . '@student.dz',
                    'phone' => '0' . fake()->numberBetween(500000000, 700000000),
                    'birth_date' => fake()->dateTimeBetween('-25 years', '-18 years'),
                    'gender' => fake()->randomElement(['male', 'female']),
                    'formation_type' => 'presential',
                    'status' => 'active',
                    'entry_date' => now()->subMonths(6),
                ]);
            }
        }
    }
}
