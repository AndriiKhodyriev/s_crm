<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    public function city(){
        return $this->belongsTo('App\City');
    }

    public function ticketStatus(){
        return $this->belongsTo('App\TicketStatus');
    }
    public function userCreate(){
        return $this->belongsTo('App\User','create_user_id', 'id');//select * from users 
                                                                    //where наш joins.create_user_id 
                                                                    // = 
                                                                     // users.id
    }

	public function userClose(){
        return $this->belongsTo('App\User','close_user_id', 'id');
    }


	/*public function close_user(){
        return $this->belongsTo('App\User');
    }*/
}
 
 