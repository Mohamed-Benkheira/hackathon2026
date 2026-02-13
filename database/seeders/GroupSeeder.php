<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\ClassModel;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        // Each class has 2-4 groups (A, B, C, D)
        ClassModel::all()->each(function ($class) {
            $groupCount = rand(2, 4);
            $groupNames = ['A', 'B', 'C', 'D'];

            for ($i = 0; $i < $groupCount; $i++) {
                Group::factory()->create([
                    'class_id' => $class->id,
                    'name' => $groupNames[$i],
                ]);
            }
        });
    }
}
