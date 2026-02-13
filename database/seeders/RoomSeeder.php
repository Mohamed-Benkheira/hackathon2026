<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        // 20 rooms in the institute
        Room::factory()->count(20)->create();
    }
}
