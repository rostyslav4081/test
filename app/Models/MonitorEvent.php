<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonitorEvent extends Model
{
    protected $connection = 'pgsql_monitor';
    protected $table = 'events';   // ← зміниш на свою таблицю
    public $timestamps = false;

    protected $fillable = [
        'id',
        'device_id',
        'event_type',
        'created_at',
        'description',
    ];
}
