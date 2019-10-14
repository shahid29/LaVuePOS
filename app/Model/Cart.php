<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id',
        'product_name',
        'product_quantity',
        'product_price',
        'sub_total',
    ];
}
