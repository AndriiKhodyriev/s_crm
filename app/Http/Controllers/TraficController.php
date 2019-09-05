<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BDCOMall;
use App\Trafic;

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
        // $trafic_check = Trafic::all();
        // $trafic_check = Trafic::select(['mac', 'interface', 'input', 'output'])
        //                            ->where('date', '>', $date_Start)
        //                            ->where('date', '<', $date_Stop)
        //                            ->orderBy('input')->get();
        // $result['trafic'] = $trafic_check;
        if ($id == 0) {
                $error_mes = "Необходимо указать IP BDCOM";
                $result['error'] = $error_mes;
                return response()->json($result);
        } else {
            $trafic_check = Trafic::select(['mac', 'interface', 'input', 'output'])
                            ->where('date', '>', $date_Start)
                            ->where('date', '<', $date_Stop)
                            ->orderBy('input', 'desc')
                            ->get();
            $result['trafic_input'] = $trafic_check;
        }
        $result['num'] = $id;
        
        // // foreach($sum as $s ) {
        // //     $result['sum'] = $s->sum;
        // // }
        // // $result['logins'] = $abons;
        // // $count = count($abons);
        // // $result['count'] = $count;
        // $trafic_check = Trafic::select(['mac', 'interface', 'input', 'output'])
        //                         ->where('date', '>', $date_Start)
        //                         ->where('date', '<', $date_Stop)
        //                         ->orderBy('input')->get();
        return response()->json($result);
    }
}