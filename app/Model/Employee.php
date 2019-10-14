<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        'name',
        'email',
        'adddress',
        'salary',
        'joinning_date',
        'nid',
        'phone',
    ];

    public function salary(){
        return $this->belongsTo(Salary::class);
    }
}
