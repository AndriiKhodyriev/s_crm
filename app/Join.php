<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Join extends Model
{
    public function city(){
        return $this->belongsTo('App\City');
    }

    public function ticketStatus(){
        return $this->belongsTo('App\TicketStatus');
    }
    public function user(){
        return $this->belongsTo('App\User','create_user_id', 'id');//select * from users 
                                                                    //where наш joins.create_user_id 
                                                                    // = 
                                                                     // users.id
    }
	/*public function close_user(){
        return $this->belongsTo('App\User');
    }*/
}
 
 /*iptables -t nat -I POSTROUTING -d 192.168.0.0/24 -j SNAT --to-source 192.168.0.253
 iptables -t nat -D POSTROUTING -d 192.168.0.0/24 -j SNAT --to-source 192.168.0.1

iptables -t nat -I PREROUTING  -p tcp -d 194.242.98.158 --dport 51001 -j DNAT --to-destination 192.168.0.1:80 
*/