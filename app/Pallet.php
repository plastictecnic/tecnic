<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pallet extends Model
{
    protected $fillable = [
        'sn', 'status', 'color', 'location_id', 'user_id'
    ];

    public function shippments(){
        return $this->belongsToMany('App\Shippment');
    }

    public function location(){
        return $this->belongsTo('App\Location');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
