<?php

namespace Database\Factories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    protected $model = Room::class;

    private static $counter = 1;

    public function definition(): array
    {
        $building = $this->faker->randomElement(['A', 'B', 'C']);
        $floor = $this->faker->numberBetween(0, 2);
        $number = str_pad(self::$counter, 2, '0', STR_PAD_LEFT);
        self::$counter++;

        return [
            'name' => "Salle {$building}{$floor}{$number}",
            'code' => "{$building}{$floor}{$number}",
            'building' => "Bâtiment {$building}",
            'capacity' => $this->faker->randomElement([30, 35, 40, 50, 60]),
            'type' => $this->faker->randomElement(['classroom', 'lab', 'workshop', 'amphitheater']),
            'is_active' => true,
        ];
    }
}
