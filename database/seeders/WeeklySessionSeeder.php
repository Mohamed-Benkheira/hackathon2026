<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Module;
use App\Models\Room;
use App\Models\Teacher;
use App\Models\WeeklySession;
use Illuminate\Database\Seeder;

class WeeklySessionSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Group::all()->take(10) as $group) {
            $module = Module::where('institute_id', $group->institute_id)
                ->where('class_id', $group->class_id)
                ->first();

            $teacher = Teacher::where('institute_id', $group->institute_id)
                ->inRandomOrder()
                ->first();

            $room = Room::where('institute_id', $group->institute_id)
                ->inRandomOrder()
                ->first();

            if ($module && $teacher && $room) {
                WeeklySession::create([
                    'group_id' => $group->id,
                    'module_id' => $module->id,
                    'teacher_id' => $teacher->id,
                    'room_id' => $room->id,
                    'day_of_week' => rand(1, 5),
                    'slot_start' => '08:00',
                    'slot_end' => '10:00',
                    'slot_number' => 1,
                    'session_type' => 'theory',
                    'is_active' => true,
                    'week_repeats' => 'every_week',
                ]);
            }
        }
    }
}
