<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent model for `data_tnsHistoryElmeter` table.
 * Composite primary key: deviceId, timestamp (handle manually)
 */
class DataTnsHistoryElmeter extends Model
{
    /**
     * @var string
     */
    protected $table = 'data_tnsHistoryElmeter';

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