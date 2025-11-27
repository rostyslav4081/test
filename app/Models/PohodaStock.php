<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PohodaStock extends Model
{
    protected $connection = 'pohoda';
    protected $table = 'STOCK'; // таблиця в MSSQL
    public $timestamps = false;

    protected $fillable = [
        'ID',
        'PLU',
        'NAME',
        'PRICE',
    ];
}

