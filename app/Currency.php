<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public function order(){
        return $this->belongsTo('App\Order', 'currency_id', 'id');
    }
}
