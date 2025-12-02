<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent model for `sys_deviceUptime` table.
 * Composite primary key: timestamp, deviceId (handle manually)
 */
class SysDeviceUptime extends Model
{
    /**
     * @var string
     */
    protected $table = 'sys_deviceUptime';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key is not a simple single column.
     * Handle composite or missing primary key manually if needed.
     */
    public $incrementing = false;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

}