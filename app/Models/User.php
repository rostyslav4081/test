<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * Таблиця + ключі з оригінального MonitorWeb
     */
    protected $connection = 'pgsql_monitor';
    protected $table = 'sys_users';
    protected $primaryKey = 'id';
    public $timestamps = false;
    public $rememberTokenName = false;



    /**
     * Дозволені для масового заповнення поля
     * (щоб не було Guarded attribute assignment)
     */
    protected $fillable = [
        'id',
        'email',
        'password',
        'role',
        'locationId',
        'locName',
        'lastLogin',
        'lastActivity',
        'activityCnt',
        'enabled',
    ];

    /**
     * Приховані при серіалізації
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Додаткові "віртуальні" атрибути
     * – будуть доступні як $user->location_name
     */
    protected $appends = [
        'location_name',
    ];

    /**
     * Аксесор для властивості location_name
     * (щоб у Blade працювало auth()->user()->location_name)
     */
    public function getLocationNameAttribute()
    {
        return $this->locName;
    }

    /**
     * Кастинг типів
     */
    protected $casts = [
        'lastLogin'    => 'datetime',
        'lastActivity' => 'datetime',
        'enabled'      => 'boolean',
        'locationId'   => 'integer',
    ];
}
