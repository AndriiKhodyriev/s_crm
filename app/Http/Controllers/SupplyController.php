<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SupplyController extends Controller
{
    //
    public function index() 
    {
        return view('supply.index');
    }
}
