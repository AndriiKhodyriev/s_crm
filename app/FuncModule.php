<?php
use App\Abon;
use App\JoinsLog;
use App\RepairsLog;
//Для логов желательно использовать прямые название городов и статусов заявок
//подключаем модели городов и статусов + типов подключения 
use App\City;
use App\TConnection;
use App\TicketStatus;

if(!function_exists('update_abon')) { 
    function update_abon($request, $abon, $city_id, $t_connection) {
        if ($city_id == 0) {
            if ($t_connection == 0) {
                //Если PON
                if_update_abon($abon, $request);
            //Если выбран тот же тип подключения что и в базе (не выполнять перезапись)
            } elseif ($t_connection == $abon->t_connection_id) {
                //Если PON
                if_update_abon($abon, $request);
            //если выбран другой тип подключения - изменить его в карточке 
            } else {
                $abon->t_connection_id = $t_connection;
                //Если PON
                if_update_abon($abon, $request);
            }
        //если город указан, то необходимо его перезаписать в карточку
        } else {
            ($abon->city_id != $city_id) ? $abon->city_id = $city_id : "НЕТ ИЗМ";
            if ($t_connection == 0) {
                //Если PON
                if_update_abon($abon, $request);
            //Если выбран тот же тип подключения что и в базе (не выполнять перезапись)
            } elseif ($t_connection == $abon->t_connection_id) {
                //Если PON
                if_update_abon($abon, $request);
            //если выбран другой тип подключения - изменить его в карточке 
            } else {
                $abon->t_connection_id = $t_connection;
                if_update_abon($abon, $request);
            }   
        };
    }
}
if(!function_exists('if_update_abon')) { 
    function if_update_abon($abon, $request){
        //если подключение по PON
        if ($abon->t_connection_id == 1) {
            pon_update_abon($abon, $request);
        //Если подключение по WiFi
        } elseif ($abon->t_connection_id == 2) {
            wifi_update_abon($abon, $request);
        //Если подключение по кабелю
        } elseif ($abon->t_connection_id == 3) {
            $abon->save();
        }
    }
}
if(!function_exists('pon_update_abon')) { 
    function pon_update_abon($abon, $request){
        ($abon->mac_onu         != $request->input('mac_onu'))          ? $abon->mac_onu = $request->input('mac_onu') : "НЕТ ИЗМ";
        ($abon->point_inc       != $request->input('point_inc'))        ? $abon->point_inc = $request->input('point_inc') : "НЕТ ИЗМ";
        $abon->save();
    }
}
if(!function_exists('wifi_update_abon')) { 
    function wifi_update_abon($abon, $request){
        ($abon->base_ip         != $request->input('base_ip'))          ? $abon->base_ip = $request->input('base_ip') : "НЕТ ИЗМ";
        ($abon->client_ip       != $request->input('client_ip'))        ? $abon->client_ip = $request->input('client_ip') : "НЕТ ИЗМ";
        $abon->save();
    }
}

// Функции для работы с логами по заявкам на подключение 

if(!function_exists('log_create_join')){
    //функция записи лога при создании новой заявки (нет необходимости дублировать всю заполненную информацию, записываем только стандартное сообщение )
    //и данные о том, кто создал и по какой заявке 
    function log_create_join($user_id, $join_id){
         $joinLog           = new JoinsLog;
         $joinLog->join_id  = $join_id;
         $joinLog->user_id  = $user_id;
         $joinLog->info_log  = "Создана заявка на подключение!";
         $joinLog->save();
    }
}

    //функция записи лога при изменение (редактировании) заявки на подключение 
    // передаются все данные по этой заявке + передаются данные которые вводит пользователь 
    // сраниваем данные и записываем в лог, только то, что было модифицированно 
if(!function_exists('log_modif_join')){
    function log_modif_join($join, $request, $user_id){
        $text = "Были модификации : ";
        if($request->input('city_name') != 0) {
            $cityNew = City::find($request->input('city_name'));
            $cityOld = City::find($join->city_id);
            $text .= "<br> ->  Город: " . $cityOld->name . " => " . $cityNew->name;
        }
        if($request->input('status_name') != 0){
            $statusNew = TicketStatus::find($request->input('status_name'));
            $statusOld = TicketStatus::find($join->ticket_status_id);
            $text .= "<br> ->  Статус: " . $statusOld->name . " => " . $statusNew->name;
        }
        ($join->street      != $request->input('street'))    ?   $text .= "<br> -> Улица: " . $join->street . " => " . $request->input('street') : "NO MOD";
        ($join->build       != $request->input('build'))     ?   $text .= "<br> ->  Дом: " . $join->build . " => " . $request->input('build') : "NO MOD";
        ($join->full_name   != $request->input('full_name')) ?   $text .= "<br> ->  ФИО: " . $join->full_name . " => " . $request->input('full_name') : "NO MOD";
        ($join->phone_num   != $request->input('phone_num')) ?   $text .= "<br> ->  Телефон: " . $join->phone_num . " => " . $request->input('phone_num') : "NO MOD";
        ($join->comment     != $request->input('comment'))   ?   $text .= "<br> ->  Комментарий: " . $join->comment . " => " . $request->input('comment') : "NO MOD";
        ($join->join_area   != $request->input('join_area')) ?   $text .= "<br> ->  Место включения: " . $join->join_area . " => " . $request->input('join_area') : "NO MOD";
        $joinLog            = new JoinsLog;
        $joinLog->join_id   = $join->id;
        $joinLog->user_id   = $user_id;
        $joinLog->info_log  = $text;
        $joinLog->save();
    }
}

// Конец функций для работы с логами по заявкам на подключение 
// Начало функций для работы с логами по заявкам на ремонт 
if(!function_exists('log_create_repair')){
    function log_create_repair($user_id, $repair_id){
        $repLog     = new RepairsLog;
        $repLog->user_id = $user_id;
        $repLog->repair_id = $repair_id;
        $repLog->info_log  = "Заявка на ремонт сформирована";
        $repLog->save();
    }
}

if(!function_exists('log_mod_repair')){
    function log_mod_repair($repair, $request, $user_id){
        $text = "Были модификации : ";

        if($request->input('status_name') != 0) {
            $statusNew = TicketStatus::find($request->input('status_name'));
            $statusOld = TicketStatus::find($repair->ticket_status_id);
            ($repair->ticket_status_id != $request->input('status_name'))   ? $text .= "<br> -> Статус заявки: " . $statusOld->name . " => " . $statusNew->name : "NO MOD"; 
        }
        
        if($request->input('city_name') != 0) {
            $cityNew = City::find($request->input('city_name'));
            $cityOld = City::find($repair->city_id);
            ($repair->city_id != $request->input('city_name'))  ? $text .= "<br> -> Город: " . $cityOld->name . " => " . $cityNew->name : "NO MOD";
        }


        ($repair->login              != $request->input('login'))       ? $text .= "<br> -> Логин: " . $repair->login . " => " . $request->input('login') : "NO MOD";
        ($repair->street             != $request->input('street'))     ? $text .= "<br> -> Улица: " . $repair->street . " => " . $request->input('street') : "NO MOD";
        ($repair->build              != $request->input('build'))      ? $text .= "<br> -> Дом: " . $repair->build . " => " . $request->input('build') : "NO MOD";
        ($repair->phone_num          != $request->input('phone_num'))  ? $text .= "<br> -> Номер телефона: " . $repair->phone_num . " => " . $request->input('phone_num') : "NO MOD";
        ($repair->vlan_name          != $request->input('vlan_name'))  ? $text .= "<br> -> VLAN: " . $repair->vlan_name . " => " . $request->input('vlan_name') : "NO MOD";
        ($repair->cause              != $request->input('cause'))      ? $text .= "<br> -> Причина обращения: " . $repair->cause . " => " . $request->input('cause') : "NO MOD";
        ($repair->comment            != $request->input('comment'))    ? $text .= "<br> -> Комментарий: " . $repair->cause . " => " . $request->input('comment') : "NO MOD";
        
        $repLog     = new RepairsLog;
        $repLog->user_id = $user_id;
        $repLog->repair_id = $repair->id;
        $repLog->info_log = $text;
        $repLog->save();
    }
}

// Конец функций для работы с логами по заявкам на ремонт 