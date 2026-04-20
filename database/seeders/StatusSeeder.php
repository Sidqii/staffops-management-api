<?php

namespace Database\Seeders;

use App\Models\Management\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Status::create(['name' => Status::PENDING]);
        Status::create(['name' => Status::IN_PROGRESS]);
        Status::create(['name' => Status::COMPLETED]);
    }
}
