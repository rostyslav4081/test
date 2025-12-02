<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'sys_users';
    protected $primaryKey = 'id';
    public $timestamps = false; // Using custom timestamps

    protected $fillable = [
        'id',
        'email',
        'password',
        'role',
        'lastLogin',
        'lastActivity',
        'activityCnt',
        'enabled',
    ];

    protected $hidden = [
        'password',
    ];

    protected $casts = [
        'lastLogin' => 'datetime',
        'lastActivity' => 'datetime',
        'enabled' => 'boolean',
    ];
}
