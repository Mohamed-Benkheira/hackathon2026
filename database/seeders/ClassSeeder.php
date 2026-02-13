<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class ClassSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Specialty::all() as $specialty) {
            for ($i = 1; $i <= 2; $i++) {
                \DB::table('classes')->insert([
                    'institute_id' => $specialty->institute_id,
                    'specialty_id' => $specialty->id,
                    'semester_number' => $i,
                    'certificate' => 'TS',
                    'name_ar' => 'السنة ' . $i,
                    'name_fr' => 'Année ' . $i,
                    'duration_months' => 12,
                    'start_date' => now()->subMonths(6),
                    'end_date' => now()->addMonths(6),
                    'is_active' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
