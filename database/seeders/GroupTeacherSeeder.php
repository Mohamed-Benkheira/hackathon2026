<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class GroupTeacherSeeder extends Seeder
{
    public function run(): void
    {
        // Assign 1-3 teachers per group
        Group::all()->each(function ($group) {
            $teachers = Teacher::inRandomOrder()->limit(rand(1, 3))->get();

            foreach ($teachers as $index => $teacher) {
                $group->teachers()->attach($teacher->id, [
                    'role' => $index === 0 ? 'responsible' : 'assistant',
                    'assigned_date' => now()->subDays(rand(30, 365)),
                ]);
            }
        });
    }
}
