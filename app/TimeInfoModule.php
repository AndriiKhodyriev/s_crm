<?php 

namespace App\Modules;
use App\Join;
use App\Repair;


if(!function_exists('checkOverdueRequest')){
    function checkOverdueRequest(){
        // $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
        //                         'close_user_id', 'create_user_id', 'join_area', 'updated_at'])
        //                     ->where('ticket_status_id', '!=', 3)
        //                     ->get();
        $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                            'created_at', 'ticket_status_id', 'create_user_id', 'close_user_id', 'updated_at'])
                            ->where('ticket_status_id', '!=', 3)
                            ->get();

        $today = date("Y-m-d H:i:s");
        // foreach($joins as $join){
        //     $date1 = $join->created_at;
        //     $date2 = $today;
        //     $diff = abs(strtotime($date2) - strtotime($date1));
        //     $days = dayVal($diff);  

        //     if($days > 3) {
        //         $chat_id = $join->city->chat_id;
        //         $text = "Просроченная заявка на подключение "
        //         sendMessage($text, $chat_id)
        //     }
        // }

        foreach($repairs as $repair) {
            $date1 = $repair->created_at;
            $date2 = $today;
            $diff = abs(strtotime($date2) - strtotime($date1));
            $days = dayVal($diff); 

            if($days > 3) {
                $chat_id = $repair->city->chat_id;
                $text = "ПРОСРОЧЕНАЯ ЗАЯВКА НА РЕМОНТ!\r\n \r\n Адресс: " . $repair->street . " Дом : " . $repair->build
                        . "\r\n Телефон : "             . $repair->phone_num
                        . "\r\n ЛОГИН : "               . $repair->login
                        . "\r\n VLAN : "                . $repair->vlan_name
                        . "\r\n Причина : "             . $repair->cause
                        . "\r\n Комментарий : "         . $repair->comment
                        . "\r\n Дата создания : "       . $repair->created_at;
                sendMessage($text, $chat_id);
            }
        }
    }
}

    function dayVal($diff){
        $years = floor($diff / (365*60*60*24));
        $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
        $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        return $days;
    }