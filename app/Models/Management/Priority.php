<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    protected $fillable = [
        'name',
    ];

    public const LOW = 'low';

    public const MEDIUM = 'medium';

    public const HIGH = 'high';

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
