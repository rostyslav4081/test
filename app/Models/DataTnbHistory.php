<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Eloquent model for `data_tnbHistory` table.
 * Composite primary key: deviceId, timestamp (handle manually)
 */
class DataTnbHistory extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_tnbHistory';

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
     * Get the related DataDevice for this record.
     */
    public function dataDevice(): BelongsTo
    {
        return $this->belongsTo(DataDevice::class, 'deviceId');
    }

}