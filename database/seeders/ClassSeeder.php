<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Specialty;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        // For each specialty, create 3 semesters (S1, S2, S3)
        Specialty::all()->each(function ($specialty) {
            for ($semester = 1; $semester <= 3; $semester++) {
                ClassModel::factory()->create([
                    'specialty_id' => $specialty->id,
                    'semester_number' => $semester,
                    'certificate' => $specialty->certificate_types[0] ?? 'TS',
                    'name_ar' => "السنة {$semester}",
                    'name_fr' => "Semestre {$semester}",
                ]);
            }
        });
    }
}
