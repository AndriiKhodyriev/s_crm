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
}