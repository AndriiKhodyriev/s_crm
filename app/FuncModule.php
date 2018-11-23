<?php
use App\Abon;

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