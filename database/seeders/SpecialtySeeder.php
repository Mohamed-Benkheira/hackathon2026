<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        $specialties = [
            ['name_ar' => 'تقني سامي في الإعلام الآلي', 'name_fr' => 'TS Informatique', 'code' => 'TSI', 'role' => 'presential'],
            ['name_ar' => 'تقني في المحاسبة', 'name_fr' => 'Technicien Comptabilité', 'code' => 'TC', 'role' => 'apprentice'],
            ['name_ar' => 'ميكانيك السيارات', 'name_fr' => 'Mécanique Auto', 'code' => 'MA', 'role' => 'presential'],
        ];

        foreach (Institute::all() as $institute) {
            foreach ($specialties as $spec) {
                Specialty::create([
                    'institute_id' => $institute->id,
                    'name_ar' => $spec['name_ar'],
                    'name_fr' => $spec['name_fr'],
                    'code' => $spec['code'],
                    'role' => $spec['role'],
                    'certificate_types' => json_encode(['TS', 'BTS']),
                    'duration_months' => 24,
                ]);
            }
        }
    }
}
