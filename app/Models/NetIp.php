<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NetIp extends Model
{
    protected $table = 'net_ips';
    public $incrementing = false;
    public $timestamps = false;
    protected $primaryKey = 'ip'; // Assuming IP is unique, otherwise set to null

    protected $fillable = [
        'hostname',
        'ip',
        'from',
        'to',
        'resolveTimestamp',
    ];

    protected $casts = [
        'resolveTimestamp' => 'datetime',
    ];
}
