<?php

namespace Database\Seeders;

use App\Models\ModuleGrade;
use App\Models\Student;
use App\Models\Module;
use Illuminate\Database\Seeder;

class ModuleGradeSeeder extends Seeder
{
    public function run(): void
    {
        // Create grades for each student in their class modules
        Student::with('group.class.modules')->chunk(100, function ($students) {
            foreach ($students as $student) {
                if (!$student->group || !$student->group->class)
                    continue;

                $modules = $student->group->class->modules;

                foreach ($modules as $module) {
                    ModuleGrade::factory()->create([
                        'student_id' => $student->id,
                        'module_id' => $module->id,
                        'coefficient' => $module->coefficient,
                    ]);
                }
            }
        });
    }
}
