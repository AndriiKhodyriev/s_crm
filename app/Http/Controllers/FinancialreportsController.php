<?php

namespace App\Http\Controllers;
use App\City;
use App\Abon;
use App\Moduls\Query;
use App\Moduls\Func;
use Illuminate\Http\Request;

class FinancialreportsController extends Controller
{
    public function index() 
    {
        // $abons = Abon::all();
        $cities = City::all();
        // $t_connections = TConnection::all();
        return view('financialreports.index')->with(['cities' => $cities]);
    }

    public function report(Request $request){ 
        $id = $request->city_id;
        $date = $request->date;
        //Разбор получаемой даты (с ней все выборки)
        $date_F = explode(">", $date);
        //После разбива получим (date_Start[0] - месяц, date_Start[1] - день, date_Start[2] - год) 
        $date_Start =  $date_F[0];
        $date_Stop = $date_F[1];
        //ФОРМАТ ДАТЫ В MySql YYYY-MM-DD 
        $abons = Abon::select(['id', 'city_id', 'created_at', 'password', 
                                'point_inc' ,'login', 'fullname','tarif_plan', 
                                'street', 'build', 'flat', 'phone', 'leng', 'all_money', 
                                'comment', 't_connection_id'])
                            ->where('created_at', '>', $date_Start)
                            ->where('created_at', '<', $date_Stop)
                            ->get();
        $count = count($abons);
        return response()->json($count);
    }
}
