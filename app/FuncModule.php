<?php
use App\Abon;

if(!function_exists('update_abon')) { 
    function update_abon($request, $abon, $city_id, $t_connection) {
        if ($city_id == 0) {
            if ($t_connection == 0) {
                //Если PON
                if ($abon->t_connection_id == 1) {
                    ($abon->mac_onu         != $request->input('onu_mac'))          ? $abon->mac_onu = $request->input('onu_mac') : "НЕТ ИЗМ";
                    ($abon->point_inc       != $request->input('point_inc'))        ? $abon->mac_onu = $request->input('point_inc') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по WiFi
                } elseif ($abon->t_connection_id == 2) {
                    ($abon->base_ip         != $request->input('base_ip'))          ? $abon->base_ip = $request->input('base_ip') : "НЕТ ИЗМ";
                    ($abon->client_ip       != $request->input('client_ip'))        ? $abon->mac_onu = $request->input('client_ip') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по кабелю
                } elseif ($abon->t_connection_id == 3) {
                    $abon->save();
                }
               // return redirect('/abons')->with('error', 'ВСЕ ЗБС!!!!');
            //Если выбран тот же тип подключения что и в базе (не выполнять перезапись)
            } elseif ($t_connection == $abon->t_connection_id) {
                //Если PON
                if ($abon->t_connection_id == 1) {
                    ($abon->mac_onu         != $request->input('onu_mac'))          ? $abon->mac_onu = $request->input('onu_mac') : "НЕТ ИЗМ";
                    ($abon->point_inc       != $request->input('point_inc'))        ? $abon->mac_onu = $request->input('point_inc') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по WiFi
                } elseif ($abon->t_connection_id == 2) {
                    ($abon->base_ip         != $request->input('base_ip'))          ? $abon->base_ip = $request->input('base_ip') : "НЕТ ИЗМ";
                    ($abon->client_ip       != $request->input('client_ip'))        ? $abon->mac_onu = $request->input('client_ip') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по кабелю
                } elseif ($abon->t_connection_id == 3) {
                    $abon->save();
                }
            //если выбран другой тип подключения - изменить его в карточке 
            } else {
                $abon->t_connection_id = $t_connection;
                //Если PON
                if ($abon->t_connection_id == 1) {
                    ($abon->mac_onu         != $request->input('onu_mac'))          ? $abon->mac_onu = $request->input('onu_mac') : "НЕТ ИЗМ";
                    ($abon->point_inc       != $request->input('point_inc'))        ? $abon->mac_onu = $request->input('point_inc') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по WiFi
                } elseif ($abon->t_connection_id == 2) {
                    ($abon->base_ip         != $request->input('base_ip'))          ? $abon->base_ip = $request->input('base_ip') : "НЕТ ИЗМ";
                    ($abon->client_ip       != $request->input('client_ip'))        ? $abon->mac_onu = $request->input('client_ip') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по кабелю
                } elseif ($abon->t_connection_id == 3) {
                    $abon->save();
                }
            }
        //если город указан, то необходимо его перезаписать в карточку
        } else {
            $abon->city_id = $city_id;
            if ($t_connection == 0) {
                //Если PON
                if ($abon->t_connection_id == 1) {
                    ($abon->mac_onu         != $request->input('onu_mac'))          ? $abon->mac_onu = $request->input('onu_mac') : "НЕТ ИЗМ";
                    ($abon->point_inc       != $request->input('point_inc'))        ? $abon->mac_onu = $request->input('point_inc') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по WiFi
                } elseif ($abon->t_connection_id == 2) {
                    ($abon->base_ip         != $request->input('base_ip'))          ? $abon->base_ip = $request->input('base_ip') : "НЕТ ИЗМ";
                    ($abon->client_ip       != $request->input('client_ip'))        ? $abon->mac_onu = $request->input('client_ip') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по кабелю
                } elseif ($abon->t_connection_id == 3) {
                    $abon->save();
                }
               // return redirect('/abons')->with('error', 'ВСЕ ЗБС!!!!');
            //Если выбран тот же тип подключения что и в базе (не выполнять перезапись)
            } elseif ($t_connection == $abon->t_connection_id) {
                //Если PON
                if ($abon->t_connection_id == 1) {
                    ($abon->mac_onu         != $request->input('onu_mac'))          ? $abon->mac_onu = $request->input('onu_mac') : "НЕТ ИЗМ";
                    ($abon->point_inc       != $request->input('point_inc'))        ? $abon->mac_onu = $request->input('point_inc') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по WiFi
                } elseif ($abon->t_connection_id == 2) {
                    ($abon->base_ip         != $request->input('base_ip'))          ? $abon->base_ip = $request->input('base_ip') : "НЕТ ИЗМ";
                    ($abon->client_ip       != $request->input('client_ip'))        ? $abon->mac_onu = $request->input('client_ip') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по кабелю
                } elseif ($abon->t_connection_id == 3) {
                    $abon->save();
                }
            //если выбран другой тип подключения - изменить его в карточке 
            } else {
                $abon->t_connection_id = $t_connection;
                //Если PON
                if ($abon->t_connection_id == 1) {
                    ($abon->mac_onu         != $request->input('onu_mac'))          ? $abon->mac_onu = $request->input('onu_mac') : "НЕТ ИЗМ";
                    ($abon->point_inc       != $request->input('point_inc'))        ? $abon->mac_onu = $request->input('point_inc') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по WiFi
                } elseif ($abon->t_connection_id == 2) {
                    ($abon->base_ip         != $request->input('base_ip'))          ? $abon->base_ip = $request->input('base_ip') : "НЕТ ИЗМ";
                    ($abon->client_ip       != $request->input('client_ip'))        ? $abon->mac_onu = $request->input('client_ip') : "НЕТ ИЗМ";
                    $abon->save();
                //Если подключение по кабелю
                } elseif ($abon->t_connection_id == 3) {
                    $abon->save();
                }
            }   
        };
    }
}