<?php

namespace App\Models\Attachment;

use App\Models\Management\Task;
use Illuminate\Database\Eloquent\Model;

class TaskAttachment extends Model
{
    protected $fillable = [
        'task_id',
        'file_path',
        'file_name',
        'file_type',
    ];

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
