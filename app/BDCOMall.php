<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BDCOMall extends Model
{
    protected $table = 'b_d_c_o_malls';
    public function trafic(){ 
       return $this->hasMany('App\Trafic');
    }
}
