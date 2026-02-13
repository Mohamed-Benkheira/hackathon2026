<?php

namespace Database\Seeders;

use App\Models\WeeklySession;
use App\Models\Group;
use App\Models\Teacher;
use App\Models\Room;
use Illuminate\Database\Seeder;

class WeeklySessionSeeder extends Seeder
{
    public function run(): void
    {
        $timeSlots = [
            ['start' => '08:00', 'end' => '10:00', 'slot' => 1],
            ['start' => '10:00', 'end' => '12:00', 'slot' => 2],
            ['start' => '13:00', 'end' => '15:00', 'slot' => 3],
            ['start' => '15:00', 'end' => '17:00', 'slot' => 4],
        ];

        // Create weekly schedule for each group
        Group::with('class.modules')->get()->each(function ($group) use ($timeSlots) {
            if (!$group->class || !$group->class->modules) {
                return;
            }

            $modules = $group->class->modules;
            $teachers = Teacher::inRandomOrder()->limit($modules->count())->get();
            $rooms = Room::inRandomOrder()->limit($modules->count() * 2)->get();

            $usedSlots = []; // Track used day+slot combinations
            $roomIndex = 0;

            foreach ($modules as $moduleIndex => $module) {
                // Each module gets 2-3 sessions per week
                $sessionsPerWeek = rand(2, 3);
                $sessionsCreated = 0;

                // Try to create sessions
                $attempts = 0;
                $maxAttempts = 50;

                while ($sessionsCreated < $sessionsPerWeek && $attempts < $maxAttempts) {
                    $attempts++;

                    // Pick random day and slot
                    $day = rand(1, 5); // Monday to Friday
                    $slotIndex = rand(0, 3);
                    $slot = $timeSlots[$slotIndex];

                    // Check if this day+slot is already used for this group
                    $slotKey = "{$day}-{$slot['slot']}";

                    if (in_array($slotKey, $usedSlots)) {
                        continue; // Skip if already used
                    }

                    // Create the session
                    try {
                        WeeklySession::create([
                            'group_id' => $group->id,
                            'module_id' => $module->id,
                            'teacher_id' => $teachers[$moduleIndex]->id ?? null,
                            'day_of_week' => $day,
                            'slot_start' => $slot['start'],
                            'slot_end' => $slot['end'],
                            'slot_number' => $slot['slot'],
                            'session_type' => $module->hours_practice > $module->hours_theory ? 'practice' : 'theory',
                            'room_id' => $rooms[$roomIndex % $rooms->count()]->id ?? null,
                            'is_active' => true,
                            'week_repeats' => 'every_week',
                        ]);

                        // Mark this slot as used
                        $usedSlots[] = $slotKey;
                        $sessionsCreated++;
                        $roomIndex++;
                    } catch (\Exception $e) {
                        // Skip on duplicate, continue trying
                        continue;
                    }
                }
            }
        });
    }
}
