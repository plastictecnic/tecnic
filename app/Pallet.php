<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pallet extends Model
{
    protected $fillable = [
        'rfid', 'status', 'color', 'location_id',
    ];

    public function shippments(){
        return $this->belongsToMany('App\Shippment', 'pallet_shippment')->withTimestamps();
    }

    public function location(){
        return $this->belongsTo('App\Location');
    }
}
