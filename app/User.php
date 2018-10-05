<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function joins(){
        return $this->hasMany('App\Join', 'create_user_id', 'id'); //select * from joins 
                                                                    //where joins.create_user_id 
                                                                    // = 
                                                                     // нашему users.id
    }
    /*public function repairs()
    {
        return $this->belongsToMany('App\Repair');
    }*/
}
