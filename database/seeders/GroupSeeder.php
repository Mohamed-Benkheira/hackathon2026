<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        $classes = \DB::table('classes')->get();

        foreach ($classes as $class) {
            // Create 4 groups per class (G1, G2, G3, G4)
            for ($i = 1; $i <= 4; $i++) {
                Group::create([
                    'institute_id' => $class->institute_id,
                    'class_id' => $class->id,
                    'name' => 'G' . $i,
                    'capacity' => 30,
                    'current_students' => 0,
                ]);
            }
        }
    }
}
