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
        $bdcoms = BDCOMall::all();
        return view('trafic.index')->with('bdcoms', $bdcoms);
    }

    public function bdcomadd(Request $request)
    {
        $bdcoms = BDCOMall::all();
        $bdcom = new BDCOMall;
        $bdcom->dbcomip = $request->input('ipbdcom');
        $bdcom->save();
        return redirect('/trafic')->with('bdcoms', $bdcoms);
    }
}
