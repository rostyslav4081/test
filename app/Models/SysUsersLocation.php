<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Eloquent model for `sys_usersLocation` table.
 * Composite primary key: userId, locationId (handle manually)
 */
class SysUsersLocation extends Model
{
    /**
     * @var string
     */
    protected $table = 'sys_usersLocation';

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

    /**
     * Get the related SysUsers for this record.
     */
    public function sysUsers(): BelongsTo
    {
        return $this->belongsTo(SysUsers::class, 'userId');
    }

    /**
     * Get the related SysLocation for this record.
     */
    public function sysLocation(): BelongsTo
    {
        return $this->belongsTo(SysLocation::class, 'locationId');
    }

}