<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shippment extends Model
{

    protected $fillable = [
        'organization_id', 'vehicle_id', 'location_id', 'sn', 'status', 'created_by', 'delivvered_by', 'verified_by'
    ];

    public function organization()
    {
        return $this->belongsTo('App\Organization');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function pallets(){
        return $this->belongsToMany('App\Pallet')->withTimestamps();
    }
}
