<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Eloquent model for `sys_users` table.
 * Primary key: id
 */
class SysUsers extends Model
{
    /**
     * @var string
     */
    protected $table = 'sys_users';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    /**
     * The data type of the primary key.
     *
     * @var string
     */
    protected $keyType = 'int';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * Get related DataDeviceDetail records.
     */
    public function dataDeviceDetail(): HasMany
    {
        return $this->hasMany(DataDeviceDetail::class, 'usrId');
    }

    /**
     * Get related SysUsersLocation records.
     */
    public function sysUsersLocation(): HasMany
    {
        return $this->hasMany(SysUsersLocation::class, 'userId');
    }

}