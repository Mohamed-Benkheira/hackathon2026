<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\GroupTeacher;
use App\Models\Teacher;
use Illuminate\Database\Seeder;

class GroupTeacherSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Group::all() as $group) {
            $teacher = Teacher::where('institute_id', $group->institute_id)
                ->inRandomOrder()
                ->first();

            if ($teacher) {
                GroupTeacher::create([
                    'group_id' => $group->id,
                    'teacher_id' => $teacher->id,
                    'role' => 'responsible',
                    'assigned_date' => now(),
                ]);
            }
        }
    }
}
