<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'company_name', 'company_reg', 'type', 'address', 'postcode', 'state', 'city', 'fix_phone', 'remark'
    ];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function shippments(){
        return $this->hasMany('App\Shippment');
    }
}
