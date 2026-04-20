<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
        'name',
    ];

    public const ADMIN = 'admin';
    public const USER = 'user';

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
