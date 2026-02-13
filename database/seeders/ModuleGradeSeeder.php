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
        foreach (Student::all() as $student) {
            $modules = Module::where('institute_id', $student->institute_id)
                ->whereHas('class', function ($q) use ($student) {
                    $q->whereHas('groups', function ($g) use ($student) {
                        $g->where('id', $student->group_id);
                    });
                })
                ->take(3)
                ->get();

            foreach ($modules as $module) {
                $c1 = rand(8, 20);
                $c2 = rand(8, 20);
                $exam = rand(8, 20);
                $avg = ($c1 + $c2 + $exam) / 3;

                ModuleGrade::create([
                    'institute_id' => $student->institute_id,
                    'student_id' => $student->id,
                    'module_id' => $module->id,
                    'controle1' => $c1,
                    'controle2' => $c2,
                    'examen_final' => $exam,
                    'coefficient' => $module->coefficient,
                    'status' => $avg >= 10 ? 'validated' : 'fail',
                ]);
            }
        }
    }
}
