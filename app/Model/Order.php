<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'customer_id', 'qty', 'sub_total','vat','total',
        'payby', 'pay', 'due','order_date','order_month','order_year'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }




}
