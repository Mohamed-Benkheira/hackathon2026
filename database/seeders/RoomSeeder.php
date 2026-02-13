<?php

namespace Database\Seeders;

use App\Models\Institute;
use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        foreach (Institute::all() as $institute) {
            for ($i = 1; $i <= 5; $i++) {
                Room::create([
                    'institute_id' => $institute->id,
                    'name' => 'Salle ' . $i,
                    'code' => 'S' . $institute->id . sprintf('%02d', $i),
                    'building' => 'Bloc A',
                    'capacity' => rand(30, 50),
                    'type' => 'classroom',
                    'is_active' => true,
                ]);
            }
        }
    }
}
