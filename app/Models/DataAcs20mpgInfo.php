<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Eloquent model for `data_acs20MpgInfo` table.
 * Primary key: deviceId
 */
class DataAcs20mpgInfo extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_acs20MpgInfo';

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
    protected $primaryKey = 'deviceId';

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
     * Get the related DataDevice for this record.
     */
    public function dataDevice(): BelongsTo
    {
        return $this->belongsTo(DataDevice::class, 'deviceId');
    }

}