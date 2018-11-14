<?php


namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public $timestamps = false;
    public function joins(){
        return $this->hasMany('App\Join');
    }

    public function repairs(){ 
        return $this->hasMany('App\Repair');
    }
     public function users()
    {
        return $this->belongsToMany('App\User');
    }
    public function abons(){
        return $this->hasMany('App\Abon');
    }
}
