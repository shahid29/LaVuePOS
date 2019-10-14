<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'email',
        'address',
        'phone',
        'shopname',
        'photo',
    ];

    public function products(){
        return $this->belongsToMany('App\Product')->withTimestamps();
    }
}
