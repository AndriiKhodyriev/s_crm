<?php

namespace App\Http\Controllers;
use App\City;
use Illuminate\Http\Request;

class CitiesController extends Controller
{
    //
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index() 
    {
        $cities = City::all();
        return view('cities.index')->with('cities', $cities);
    }

    public function create()
    {
        return view('cities.create');
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'city' => 'required',
        ]);

        $city = new City;
        $city->name = $request->input('city');
        $city->save();

        return redirect('/cities')->with('success', 'Город был успешно создан!');
    }
}
