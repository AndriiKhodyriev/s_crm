<?php

namespace App\Http\Controllers;
use App\City;
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
}
