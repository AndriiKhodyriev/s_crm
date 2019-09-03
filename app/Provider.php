<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public function order(){
        return $this->belongsTo('App\Order', 'provider_id', 'id');
    }
}
