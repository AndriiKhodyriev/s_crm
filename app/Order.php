<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user() {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
    public function status() {
        return $this->belongsTo('App\Orderstatus', 'status_id', 'id');
    }
    public function provider() {
        return $this->belongsTo('App\Provider', 'provider_id', 'id');
    }
    public function currency() {
        return $this->belongsTo('App\Currency', 'currency_id', 'id');
    }
    public function city() { 
        return $this->belongsTo('App\City', 'city_id', 'id');
    }
    public function item() {
        return $this->hasMany('App\Item', 'order_id', 'id');
    }
}
