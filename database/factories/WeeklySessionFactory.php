<?php

namespace Database\Factories;

use App\Models\WeeklySession;
use App\Models\Group;
use App\Models\Module;
use App\Models\Teacher;
use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class WeeklySessionFactory extends Factory
{
    protected $model = WeeklySession::class;

    // CFPA typical time slots
    private static $timeSlots = [
        ['start' => '08:00', 'end' => '10:00', 'slot' => 1],
        ['start' => '10:00', 'end' => '12:00', 'slot' => 2],
        ['start' => '13:00', 'end' => '15:00', 'slot' => 3],
        ['start' => '15:00', 'end' => '17:00', 'slot' => 4],
    ];

    public function definition(): array
    {
        $slot = $this->faker->randomElement(self::$timeSlots);

        return [
            'group_id' => Group::factory(),
            'module_id' => Module::factory(),
            'teacher_id' => Teacher::factory(),
            'day_of_week' => $this->faker->numberBetween(1, 5), // Mon-Fri
            'slot_start' => $slot['start'],
            'slot_end' => $slot['end'],
            'slot_number' => $slot['slot'],
            'session_type' => $this->faker->randomElement(['theory', 'practice', 'lab']),
            'room_id' => Room::factory(),
            'is_active' => true,
            'week_repeats' => 'every_week',
        ];
    }
}
