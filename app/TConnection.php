<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TConnection extends Model
{
    //
    public function abons(){
        return $this->hasMany('App\Abon');
    }
}
