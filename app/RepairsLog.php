<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RepairsLog extends Model
{
    //
    public function userLog(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function repairsLog(){
        return $this->belongsTo('App\Repair', 'repair_id', 'id');
    }
}
