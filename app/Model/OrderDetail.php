<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $fillable = [
        'order_id', 'product_id', 'product_quantity','product_price','sub_total',
    ];

    public function products(){
        return $this->belongsToMany(Product::class);
    }
    public function orders(){
        return $this->belongsToMany(Order::class);
    }
}
