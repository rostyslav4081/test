<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehConnUser extends Model
{
    // 🔴 ЦЕ ГОЛОВНЕ:
    protected $connection = 'pgsql_monitor';

    protected $table = 'wareh_connUsers';
    protected $primaryKey = null;
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];

    protected $casts = [
        'timestamp'  => 'datetime',
        'pc_online'  => 'boolean',
        'pc_active'  => 'boolean',
        'pohoda'     => 'boolean',
    ];
}
