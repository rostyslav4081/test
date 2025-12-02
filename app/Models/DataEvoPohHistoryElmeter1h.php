<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent model for `data_evoPohHistoryElmeter1h` table.
 * Composite primary key: deviceId, timestamp (handle manually)
 */
class DataEvoPohHistoryElmeter1h extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_evoPohHistoryElmeter1h';

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