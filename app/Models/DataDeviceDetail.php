<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Eloquent model for `data_deviceDetail` table.
 * Primary key: addTimestamp
 */
class DataDeviceDetail extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_deviceDetail';

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
    protected $primaryKey = 'addTimestamp';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
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
        return $this->belongsTo(SysUsers::class, 'usrId');
    }

}