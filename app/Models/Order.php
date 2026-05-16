<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_name',
        'phone',
        'address',
        'notes',
        'items',
        'delivery_area',
        'delivery_price',
        'items_total',
        'total_price',
    ];
}