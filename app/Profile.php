<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id', 'gender', 'hp', 'address', 'postcode', 'city', 'state'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
