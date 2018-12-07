<?php

namespace App\Http\Controllers;
use App\City;
use App\Abon;
use App\Moduls\Query;
use App\Moduls\Func;
use Illuminate\Http\Request;
use DB;

class FinancialreportsController extends Controller
{
    public function index() 
    {
        $cities = City::all();
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
        $result = [];
        if ($id == 0) {
            $sum = DB::table('abons')
                    ->select(DB::raw('SUM(all_money) as sum'))->where('created_at', '>', $date_Start)->where('created_at', '<', $date_Stop)->get();
            $abons = Abon::select(['created_at', 'login', 'comment'])->where('created_at', '>', $date_Start)->where('created_at', '<', $date_Stop)
                            ->get();
        } else {
            $sum = DB::table('abons')
                    ->select(DB::raw('SUM(all_money) as sum'))->where('created_at', '>', $date_Start)->where('created_at', '<', $date_Stop)
                    ->where('city_id', '=', $id)
                    ->get();
            $abons = Abon::select(['created_at', 'login', 'comment'])->where('created_at', '>', $date_Start)->where('created_at', '<', $date_Stop)
                            ->where('city_id', '=', $id)
                            ->get();
        }
        
        foreach($sum as $s ) {
            $result['sum'] = $s->sum;
        }
        $result['logins'] = $abons;
        $count = count($abons);
        $result['count'] = $count;
        return response()->json($result);
        
    }
}
