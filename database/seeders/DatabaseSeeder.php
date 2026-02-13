<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            SpecialtySeeder::class,
            ClassSeeder::class,
            GroupSeeder::class,
            TeacherSeeder::class,
            StudentSeeder::class,
            ModuleSeeder::class,
            GroupTeacherSeeder::class,
            ModuleGradeSeeder::class,
            RoomSeeder::class,
            WeeklySessionSeeder::class,
            ExamSessionSeeder::class,
        ]);
    }
}
