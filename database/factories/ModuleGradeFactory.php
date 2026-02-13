<?php

namespace Database\Factories;

use App\Models\ModuleGrade;
use App\Models\Student;
use App\Models\Module;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleGradeFactory extends Factory
{
    protected $model = ModuleGrade::class;

    public function definition(): array
    {
        // Realistic grade distribution (bell curve around 11-13)
        $controle1 = $this->faker->randomFloat(2, 5, 19);
        $controle2 = $this->faker->randomFloat(2, 6, 18);
        $examenFinal = $this->faker->randomFloat(2, 4, 20);

        return [
            'student_id' => Student::factory(),
            'module_id' => Module::factory(),
            'controle1' => $controle1,
            'controle2' => $controle2,
            'examen_final' => $examenFinal,
            'coefficient' => $this->faker->numberBetween(1, 3),
            'status' => 'validated',
        ];
    }
}
