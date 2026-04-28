<?php

namespace Database\Seeders;

use App\Models\Management\Priority;
use App\Models\Management\Status;
use App\Models\Management\Task;
use App\Models\Role;
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
        $admin = User::whereHas('role', fn($q) => $q->where('name', Role::ADMIN))->first();

        $users = User::whereHas('role', fn($q) => $q->where('name', Role::USER))->get();

        $priorities = Priority::all();
        $statuses = Status::all();

        $todo = $statuses->firstWhere('name', Status::PENDING);
        $inProgress = $statuses->firstWhere('name', Status::IN_PROGRESS);
        $completed = $statuses->firstWhere('name', Status::COMPLETED);

        Task::insert([
            [
                'title' => 'Refactor the entire project structure to support a scalable and maintainable architecture while ensuring that all modules are properly decoupled, reusable, and aligned with clean architecture principles across both frontend and backend layers',

                'description' => 'Initialize folder structure and base architecture',

                'created_by' => $admin->id,
                'assigned_to' => $users->random()->id,

                'due_date' => now()->addDays(3),

                'priority_id' => $priorities->first()->id,
                'status_id' => $todo->id,

                'started_at' => null,
                'completed_at' => null,
            ],
            [
                'title' => 'Implement authentication',
                'description' => 'Build login and token handling using Sanctum. This task requires implementing a secure authentication system that handles user login, token generation, and access control across the application. Ensure that all API endpoints are properly protected and that only authorized users can access restricted resources. Handle various edge cases such as invalid credentials, expired tokens, revoked sessions, and concurrent login attempts. Additionally, ensure that error messages are user-friendly while not exposing sensitive information. The implementation should follow best practices in security, including hashing, token expiration strategies, and proper validation mechanisms. Finally, document the authentication flow clearly for future maintenance and scalability.',

                'created_by' => $admin->id,
                'assigned_to' => $users->random()->id,

                'due_date' => now()->addDays(5),

                'priority_id' => $priorities->skip(1)->first()->id,
                'status_id' => $inProgress->id,

                'started_at' => now()->subDays(2),
                'completed_at' => null,
            ],
            [
                'title' => 'Create task management API',
                'description' => null,

                'created_by' => $admin->id,
                'assigned_to' => $users->random()->id,

                'due_date' => now()->addDays(7),

                'priority_id' => $priorities->last()->id,
                'status_id' => $inProgress->id,

                'started_at' => now()->subDays(1),
                'completed_at' => null,
            ],

            [
                'title' => 'Fix API response formatting',
                'description' => 'Ensure consistent JSON response structure',

                'created_by' => $admin->id,
                'assigned_to' => $users->random()->id,

                'due_date' => now()->addDays(2),

                'priority_id' => $priorities->first()->id,
                'status_id' => $completed->id,

                'started_at' => now()->subDays(4),
                'completed_at' => now()->subDays(1),
            ],

            [
                'title' => 'Write documentation',
                'description' => 'Prepare API documentation and usage guide',

                'created_by' => $admin->id,
                'assigned_to' => $users->random()->id,

                'due_date' => now()->addDays(10),

                'priority_id' => $priorities->skip(1)->first()->id,
                'status_id' => $todo->id,

                'started_at' => null,
                'completed_at' => null,
            ],
        ]);
    }
}
