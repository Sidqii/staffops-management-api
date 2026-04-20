<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    protected $fillable = [
        'name',
    ];

    public const PENDING = 'pending';

    public const IN_PROGRESS = 'in_progress';

    public const COMPLETED = 'completed';

    public function id(string $name): int
    {
        return static::where('name', $name)->value('id');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
