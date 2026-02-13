<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            InstituteSeeder::class,     // 1st: institutes + users
            SpecialtySeeder::class,     // 2nd: specialties per institute
            ClassSeeder::class,         // 3rd: classes per specialty
            GroupSeeder::class,         // 4th: groups per class
            TeacherSeeder::class,       // 5th: teachers per institute
            StudentSeeder::class,       // 6th: students per group
            ModuleSeeder::class,        // 7th: modules per class
            RoomSeeder::class,          // 8th: rooms per institute
            GroupTeacherSeeder::class,  // 9th: assign teachers to groups
            ExamSessionSeeder::class,   // 10th: exam sessions
            WeeklySessionSeeder::class, // 11th: weekly sessions
            ModuleGradeSeeder::class,   // LAST: grades (needs students + modules)
        ]);
    }
}
