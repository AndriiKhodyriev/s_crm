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
        $all_abons = select_all_abons();
        $sum = $all_abons->where('city_id', $id);
        $count = count($sum);
     //   $join = Join::find($id);
        return response()->json($count);
    }
}
