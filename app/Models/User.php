<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // monitor DB
    protected $connection = 'pgsql_monitor';

    // Таблиця зі старого MONITOR
    protected $table = 'sys_users';

    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'email',
        'fullName',
        'role',
        'locationName',
        'locationId',
        'language',
        'password',
    ];

    protected $hidden = [
        'password',
    ];
}
