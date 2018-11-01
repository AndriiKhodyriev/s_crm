<?php

namespace App\Http\Controllers;

use App\TicketStatus;
use Illuminate\Http\Request;

class StatusesController extends Controller
{
    //
    //
    /*public function __construct()
    {
        $this->middleware('auth');
    }*/

    public function index() 
    {
        $statuses = TicketStatus::all();
        return view('statuses.index')->with('statuses', $statuses);
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);

        $status = new TicketStatus;
        $status->name = $request->input('name');
        $status->save();

        return redirect('/statuses')->with('success', 'Город был успешно создан!');
    }
}
