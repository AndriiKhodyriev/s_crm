<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JoinsLog extends Model
{
    //
    public function userLog(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function joinLog(){
        return $this->belongsTo('App\Join', 'join_id', 'id');
    }
}
