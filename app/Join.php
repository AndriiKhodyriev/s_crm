<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    public function objects(){
        return $this->belongsTo('App\Object');
    }

    public function ticketStatus(){
        return $this->belongsTo('App\TicketStatus');
    }
}
