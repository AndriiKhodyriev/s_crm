<?php

namespace App\Http\Controllers;
use App\Abon;
use App\City;
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
        return view('abons.index')->with(['abons' => $abons, 'cities' => $cities]);
    }

    public function datatablesAllAbons(){ 
        $abons = Abon::select(['id', 'city_id', 'password', 'point_inc' ,'login', 'fullname','tarif_plan', 'street', 'build', 'flat', 'phone', 'leng', 'all_money'])->get();

        return Datatables::of($abons)
                            ->addColumn('city_name', function($abon){
                                return $abon->city->name;
                            })
                            ->make(true);

    }
}
