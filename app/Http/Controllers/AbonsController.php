<?php

namespace App\Http\Controllers;
use App\Abon;
use App\City;
use App\TConnection;
use Illuminate\Http\Request;
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
    public function datatablesFindCityIDBase(Request $request, $id) { 
        $abons = Abon::select(['id', 'city_id','created_at', 'password', 'point_inc' ,'login', 'fullname','tarif_plan', 'street', 'build', 'flat', 'phone', 'leng', 'all_money', 'comment'])
                        ->where('city_id', $id)
                        ->get();
        return Datatables::of($abons)
                           // ->addColumn('login_act', function($abon){
                            //    return '<span class="label label-info">' .  $abon->login . '</span>';
                            //})
                            ->make(true);
    }
}
