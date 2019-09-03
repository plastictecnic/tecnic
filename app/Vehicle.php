<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'reg_number', 'type', 'driver_name', 'hp'
    ];

    public function shippments()
    {
        return $this->hasMany('App\Shippment');
    }
}
