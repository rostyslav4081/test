<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChargerDcsDevice extends Model
{
    protected $table = 'charger_dcs_devices';

    protected $fillable = [
        'name',
        'code',
        'location',
        'ip_address',
        'is_active',
    ];
}
