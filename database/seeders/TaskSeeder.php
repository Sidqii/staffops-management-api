<?php

namespace Database\Seeders;

use App\Models\Management\Priority;
use App\Models\Management\Status;
use App\Models\Management\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        $priorities = Priority::all();

        $statuses = Status::all();

        $letters = range('A', 'M');

        foreach ($letters as $letter) {
            $status = $statuses->random();

            $startedAt = null;

            $completedAt = null;

            if ($status->name === Status::IN_PROGRESS) {
                $startedAt = Carbon::now()->subDays(rand(1, 3));
            }

            if ($status->name === Status::COMPLETED) {
                $startedAt = Carbon::now()->subDays(rand(3, 5));
                $completedAt = Carbon::now()->subDays(rand(1, 2));
            }

            Task::create([
                'title' => "Testing task seeder {$letter}",
                'description' => "Tesing description seeder {$letter}",

                'created_by' => $users->random()->id,
                'assigned_to' => $users->random()->id,

                'due_date' => now()->addDays(rand(1, 10)),

                'priority_id' => $priorities->random()->id,
                'status_id' => $status->id,

                'started_at' => $startedAt,
                'completed_at' => $completedAt,
            ]);
        }
    }
}
