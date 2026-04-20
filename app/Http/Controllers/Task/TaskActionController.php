<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Resources\Task\TaskResource;
use App\Models\Management\Status;
use App\Models\Management\Task;

class TaskActionController extends Controller
{
    public function start(Task $task)
    {
        $this->authorize('start', $task);

        if ($task->status->name !== Status::PENDING) {
            abort(400, 'Task cannot be started');
        }

        $task->update([
            'status_id' => Status::id(Status::IN_PROGRESS),
            'started_at' => now(),
        ]);

        $task->load(['priority', 'status', 'assignee', 'creator']);

        return new TaskResource($task);
    }

    public function complete(Task $task)
    {
        $this->authorize('start', $task);

        if ($task->status->name !== Status::IN_PROGRESS) {
            abort(400, 'Task cannot be started');
        }

        $task->update([
            'status_id' => Status::id(Status::COMPLETED),
            'started_at' => now(),
        ]);

        $task->load(['priority', 'status', 'assignee', 'creator']);

        return new TaskResource($task);
    }
}
