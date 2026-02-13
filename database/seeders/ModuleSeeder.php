<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\ClassModel;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        // Each class has 6-8 modules
        ClassModel::all()->each(function ($class) {
            Module::factory()->count(rand(6, 8))->create([
                'class_id' => $class->id,
            ]);
        });
    }
}
