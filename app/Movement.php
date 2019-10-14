<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model
{
    protected $fillable = [
        'rfid', 'status', 'remark', 'user_id'
    ];
}
