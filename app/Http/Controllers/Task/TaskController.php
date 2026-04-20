<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Resources\Task\TaskResource;
use App\Models\Management\Status;
use App\Models\Management\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Task::class, 'task');
    }

    public function index(Request $request)
    {
        $sortBy = $request->input('sort_by', 'created_at');
        $order = $request->input('order', 'desc');

        $tasks = Task::query()
            ->with(['priority', 'status', 'assignee', 'creator'])
            ->visibleTo($request->user())
            ->filter($request)
            ->sort($sortBy, $order)
            ->paginate(min((int) $request->input('per_page', 10), 50));

        return TaskResource::collection($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateTaskRequest $request)
    {
        $task = Task::create([
            ...$request->validated(),

            'created_by' => $request->user()->id,
            'status_id' => Status::where('name', Status::PENDING)->value('id'),
        ]);

        $task->load(['priority', 'status', 'assignee', 'creator']);

        return new TaskResource($task);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        $task->load(['priority', 'status', 'assignee', 'creator']);

        return new TaskResource($task);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->update($request->validated());

        $task->load(['priority', 'status', 'assignee', 'creator']);

        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return response()->noContent();
    }
}
