<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketStatus extends Model
{
    public $timestamps = false;
    public function joins(){
        return $this->hasMany('App\Join');
    }

    public function repairs(){ 
        return $this->hasMany('App\Repair');
    }
}
