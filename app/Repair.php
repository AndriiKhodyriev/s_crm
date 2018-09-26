<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    public function city(){
        return $this->belongsTo('App\City');
    }

    public function ticketStatus(){ 
        return $this->belongsTo('App\TicketStatus');
    }
}
