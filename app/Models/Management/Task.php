<?php

namespace App\Models\Management;

use App\Models\Attachment\TaskAttachment;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'title',
        'description',
        'created_by',
        'assigned_to',
        'due_date',
        'priority_id',
        'status_id',
    ];

    protected array $allowedSort = [
        'created_at',
        'due_date',
        'title',
    ];

    protected function casts()
    {
        return [
            'due_date' => 'date',
            'started_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function attachments()
    {
        return $this->hasMany(TaskAttachment::class);
    }

    public function scopeSort($query, $sortby, $order)
    {
        $sortby = in_array($sortby, $this->allowedSort) ? $sortby : 'created_at';

        $order = strtolower($order) === 'asc' ? 'asc' : 'desc';

        return $query->orderBy($sortby, $order);
    }

    public function scopeVisibleTo($query, $user)
    {
        if (! $user->isAdmin()) {
            $query->where('assigned_to', $user->id);
        }

        return $query;
    }

    public function scopeOverdue($query)
    {
        return $query->whereDate('due_date', '<', now())
            ->whereHas('status', fn($q) => $q->where('name', '!=', 'completed'));
    }

    public function scopeFilter($query, $request)
    {
        if ($request->filled('status_id')) {
            $query->where('status_id', $request->get('status_id'));
        }

        if ($request->filled('status')) {
            $status = strtolower($request->get('status'));

            $query->whereHas('status', function ($q) use ($status) {
                $q->whereRaw('LOWER(name) = ?', [$status]);
            });
        }

        if ($request->filled('priority_id')) {
            $query->where('priority_id', $request->get('priority_id'));
        }

        if ($request->filled('priority')) {
            $priority = strtolower($request->get('priority'));

            $query->whereHas('priority', function ($q) use ($priority) {
                $q->whereRaw('LOWER(name) = ?', [$priority]);
            });
        }

        if ($request->filled('due_date')) {
            $query->whereDate('due_date', $request->get('due_date'));
        }

        if ($request->filled('search')) {
            $search = strtolower(trim($request->get('search')));

            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%$search%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%$search%"])
                    ->orWhereHas('status', function ($q2) use ($search) {
                        $q2->whereRaw('LOWER(name) LIKE ?', ["%$search%"]);
                    })
                    ->orWhereHas('priority', function ($q2) use ($search) {
                        $q2->whereRaw('LOWER(name) LIKE ?', ["%$search%"]);
                    })
                    ->orWhereRaw("to_char(due_date, 'YYYY-MM-DD') LIKE ?", ["%$search%"]);
            });
        }

        return $query;
    }
}
