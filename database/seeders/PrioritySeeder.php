<?php

namespace Database\Seeders;

use App\Models\Management\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Priority::create(['name' => Priority::LOW]);
        Priority::create(['name' => Priority::MEDIUM]);
        Priority::create(['name' => Priority::HIGH]);
    }
}
