<?php

namespace Database\Factories;

use App\Models\ClassModel;
use App\Models\Specialty;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassModelFactory extends Factory
{
    protected $model = ClassModel::class;

    public function definition(): array
    {
        $semester = $this->faker->numberBetween(1, 3);
        $year = $this->faker->numberBetween(2024, 2026);

        return [
            'specialty_id' => Specialty::factory(),
            'semester_number' => $semester,
            'certificate' => $this->faker->randomElement(['TS', 'BTS', 'BT', 'CMP', 'CAP']),
            'name_ar' => "السنة {$semester}",
            'name_fr' => "Semestre {$semester}",
            'duration_months' => $semester <= 2 ? 10 : 6,
            'start_date' => now()->startOfYear()->addMonths(($semester - 1) * 5),
            'end_date' => now()->startOfYear()->addMonths($semester * 5),
            'is_active' => true,
        ];
    }
}
