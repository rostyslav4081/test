<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysMetric extends Model
{
    protected $table = 'sys_metrics';
    protected $primaryKey = 'id'; // Assuming 'id' is unique
    public $timestamps = false;

    protected $fillable = [
        'id',
        'timestamp',
        'data',
    ];

    protected $casts = [
        'timestamp' => 'datetime',
        'data' => 'array', // Cast JSON column to array
    ];
}
