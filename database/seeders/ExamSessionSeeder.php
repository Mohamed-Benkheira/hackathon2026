<?php

namespace Database\Seeders;

use App\Models\ExamSession;
use App\Models\Institute;
use Illuminate\Database\Seeder;

class ExamSessionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Institute::all() as $institute) {
            ExamSession::create([
                'institute_id' => $institute->id,
                'name' => 'Session ' . now()->year,
                'class_id' => null,
                'start_date' => now()->addDays(10),
                'end_date' => now()->addDays(20),
                'status' => 'pending',
            ]);
        }
    }
}
