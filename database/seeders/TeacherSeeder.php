<?php

namespace Database\Seeders;

use App\Models\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    public function run(): void
    {
        // 50 teachers for the institute
        Teacher::factory()->count(50)->create();
    }
}
