<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WarehouseItem extends Model
{
    protected $fillable = [
        'code',
        'ean',
        'name',
        'short_text',
        'company',
        'unit',
        'quantity',
        'location',
    ];
}
