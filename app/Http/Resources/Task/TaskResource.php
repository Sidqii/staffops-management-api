<?php

namespace App\Http\Resources\Task;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'title' => $this->title,
            'description' => $this->description,

            'status' => [
                'id' => $this->status_id,
                'name' => $this->status?->name,
            ],

            'priority' => [
                'id' => $this->priority_id,
                'name' => $this->priority?->name,
            ],

            'assignee' => [
                'id' => $this->assigned_to,
                'name' => $this->assignee?->name,
            ],

            'created_by' => [
                'id' => $this->created_by,
                'name' => $this->creator?->name,
            ],

            'due_date' => $this->due_date?->format('Y-m-d'),

            'timeline' => [
                'started_at' => $this->started_at?->format('Y-m-d H:i'),
                'completed_at' => $this->completed_at?->format('Y-m-d H:i'),
            ],

            'timestamps' => [
                'created_at' => $this->created_at?->format('Y-m-d H:i'),
                'updated_at' => $this->updated_at?->format('Y-m-d H:i'),
            ],
        ];
    }
}
