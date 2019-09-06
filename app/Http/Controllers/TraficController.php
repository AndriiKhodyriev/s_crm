<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BDCOMall;
use App\Trafic;
use DB;

class TraficController extends Controller
{
    //
    public function index()
    {
        $bdcoms = BDCOMall::orderBy('dbcomip')->get();
        return view('trafic.index')->with('bdcoms', $bdcoms);
    }

    public function bdcomadd(Request $request)
    {
        $bdcoms = BDCOMall::orderBy('dbcomip')->get();
        $bdcom = new BDCOMall;
        $bdcom->dbcomip = $request->input('ipbdcom');
        $bdcom->save();
        return redirect('/trafic')->with('bdcoms', $bdcoms);
    }

    public function selecthead(Request $request)
    {
        $id = $request->head_id;
        $date = $request->date;
        // //Разбор получаемой даты (с ней все выборки)
        $date_F = explode(">", $date);
        //После разбива получим (date_Start[0] - месяц, date_Start[1] - день, date_Start[2] - год) 
        $date_Start =  $date_F[0];
        $date_Stop = $date_F[1];

         //ФОРМАТ ДАТЫ В MySql YYYY-MM-DD 
        $result = [];
       
        if ($id == 0) {
                $error_mes = "Необходимо указать IP BDCOM";
                $result['error'] = $error_mes;
                return response()->json($result);
        } else {
            $trafic_input= DB::select('SELECT MAX(input) - MIN(input) AS inputTrafic, mac, interface
                                            FROM trafics 
                                            WHERE date >= :date_start AND date <= :date_stop AND b_d_c_o_mall_id = :id
                                            GROUP BY mac, interface
                                            ORDER BY inputTrafic DESC',
                                            ['date_start' => $date_Start, 'date_stop' => $date_Stop, 'id' => $id]);
            
        $trafic_output= DB::select('SELECT MAX(output) - MIN(output) AS outputTrafic, mac, interface
                                            FROM trafics 
                                            WHERE date >= :date_start AND date <= :date_stop AND b_d_c_o_mall_id = :id
                                            GROUP BY mac, interface
                                            ORDER BY outputTrafic DESC',
                                            ['date_start' => $date_Start, 'date_stop' => $date_Stop, 'id' => $id]);

        $result['trafic_input'] = $trafic_input;
        $result['trafic_output'] = $trafic_output;

        }
        
        return response()->json($result);
    }
    public function hard()
    {
        
    }
}