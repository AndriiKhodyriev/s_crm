<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderstatus extends Model
{
    public function order(){
        $this->hasMany('App\Order', 'status_id', 'id');
    }
}
