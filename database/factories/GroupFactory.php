<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\ClassModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    protected $model = Group::class;

    public function definition(): array
    {
        return [
            'class_id' => ClassModel::factory(),
            'name' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'capacity' => $this->faker->randomElement([25, 30, 35]),
            'current_students' => 0, // Will be updated when students are created
        ];
    }
}
