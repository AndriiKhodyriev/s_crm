<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Abon extends Model
{
    //
    public function city(){
        return $this->belongsTo('App\City');
    }
    public function t_connection(){
        return $this->belongsTo('App\TConnection');
    }
    public function userCreate(){
        return $this->belongsTo('App\User','create_user_id', 'id');//select * from users 
                                                                    //where наш joins.create_user_id 
                                                                    // = 
                                                                     // users.id
    }
}
