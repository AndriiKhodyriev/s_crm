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

    public function userCreate(){
        return $this->belongsTo('App\User','create_user_id', 'id');//select * from users 
                                                                    //where наш repairs.create_user_id 
                                                                    // = 
                                                                     // users.id
    }

	public function userClose(){
        return $this->belongsTo('App\User','close_user_id', 'id');
    }
    public function repairsLog(){
        return $this->hasMany('App\RepairsLog','repair_id', 'id');
    }

}
