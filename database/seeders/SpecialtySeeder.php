<?php

namespace Database\Seeders;

use App\Models\Specialty;
use Illuminate\Database\Seeder;

class SpecialtySeeder extends Seeder
{
    public function run(): void
    {
        // Create exactly 10 real specialties
        Specialty::factory()->count(10)->create();
    }
}
