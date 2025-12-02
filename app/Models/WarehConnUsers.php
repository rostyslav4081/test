<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Eloquent model for `wareh_connUsers` table.
 * No primary key explicitly defined in schema.
 */
class WarehConnUsers extends Model
{
    /**
     * @var string
     */
    protected $table = 'wareh_connUsers';

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