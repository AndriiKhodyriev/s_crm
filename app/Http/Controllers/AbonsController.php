<?php

namespace App\Http\Controllers;
use App\Abon;
use App\City;
use App\TConnection;
use Illuminate\Http\Request;
use App\Moduls\Query;

use Datatables;
use DB;

class AbonsController extends Controller
{
    //
    public function index() 
    {
        $abons = Abon::all();
        $cities = City::all();
        $t_connections = TConnection::all();
        return view('abons.index')->with(['abons' => $abons, 'cities' => $cities, 't_connections' => $t_connections]);
    }
    public function datatablesFindCityIDBase(Request $request, $id, $type_con) { 
        $select_query = select_all_abons(); //выбираем всех абонов (часто используется App\QueryModule)
        if ($type_con == 0) {
            if ($id == 0) {
                $abons = $select_query;
            } else { 
                $abons = $select_query->where('city_id', $id);
            }
        } else {
            if ($id == 0) {
                $abons = $select_query->where('t_connection_id', $type_con);
            } else { 
                $abons = $select_query->where('city_id', $id)->where('t_connection_id', $type_con);
            }
        }
        //Делаем выборку согласно условию (город и если $type_con != 0 тогда и с учетом типа подключения)
        return Datatables::of($abons)
                            ->make(true);
    }

    public function datatablesFindTConIDBase(Request $request, $id, $city_id) {
        $select_query = select_all_abons(); 
        if ($city_id == 0) {
            if ($id == 0) {
                $abons = $select_query;
            } else { 
                $abons = $select_query->where('t_connection_id', $id);
            }
        } else {
            if ($id == 0) {
                $abons = $select_query->where('city_id', $city_id);
            } else {
                $abons = $select_query->where('t_connection_id', $id)->where('city_id', $city_id);
            }

        }
        // $city_id == 0 ? $abons = $select_query->where('t_connection_id', $id) : $abons = $select_query->where('t_connection_id', $id)->where('city_id', $city_id);
        return Datatables::of($abons)
                            ->make(true);
    }

}
