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
            'chat_id' => 'required',
            
        ]);
        $city = new City;
        $city->name = $request->input('city');
        $city->chat_id = $request->input('chat_id');
        $city->visibility_everywhere = $request->has('check');
        $city->save();
        return redirect('/cities')->with('success', 'Город был успешно создан!');
    }

    public function update(Request $request, $id) 
    {   
        $city = City::find($id);
        $city->name = $request->input('city');
        $city->chat_id = $request->input('chat_id');
        $city->visibility_everywhere = $request->has('check');
        $city->save();
        return redirect('/cities')->with('success', 'Город был изменен!');
    }

    public function citychid(Request $request){ 
        $id = $request->id;
        $city = City::find($id);
        return response()->json($city);
    }
}
