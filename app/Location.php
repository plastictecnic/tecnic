<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'code', 'name', 'description'
    ];

    public function shippments()
    {
        return $this->hasMany('App\Shippment');
    }

    public function pallets()
    {
        return $this->hasMany('App\Pallet');
    }
}
