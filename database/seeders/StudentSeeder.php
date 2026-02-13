<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Group;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        // Assign 20-30 students per group
        Group::all()->each(function ($group) {
            $studentCount = rand(20, min(30, $group->capacity));

            Student::factory()->count($studentCount)->create([
                'group_id' => $group->id,
            ]);

            // Update current_students count
            $group->update(['current_students' => $studentCount]);
        });
    }
}
