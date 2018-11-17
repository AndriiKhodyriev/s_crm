<?php
use App\Abon;

if(!function_exists('select_all_abons')) { 
    function select_all_abons() {
        $abons = Abon::select(['id', 'city_id','created_at', 'password', 
                                'point_inc' ,'login', 'fullname','tarif_plan', 
                                'street', 'build', 'flat', 'phone', 'leng', 'all_money', 
                                'comment', 't_connection_id'])
                            ->get();
        return $abons;
    };
}

