<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repair;
use Illuminate\Support\Facades\App;
use Datatables;
use Illuminate\Support\Facades\DB;

class RepairsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        //$repairs = Repair::all();
        //$locale = App::getLocale();
        //$repairs = json_decode($repairs, true);
        return view('repairs.index');
        //return view('repairs.index')->with('locale', $locale);
    }

    public function datablesAllRepairs()
    {
        //$repairs = Repairs::select(['id','login', 'street', 'build','phone_num', 'created_at', 'cause']);
        $repairs = DB::table('repairs')->select('id','login', 'street', 'build','phone_num', 'created_at', 'cause')->get();
        return Datatables::of($repairs)->make(true);

    }

    /*public function datablesAllRepairs(){ 
    $joins = DB::table('repairs')->select(['id', 'street', 'build',
    'phone_num', 
    'created_at', 'comment'])
    ->orderBy('id', 'desc');

    return Datatables::of($joins)
    ->addColumn('action', function($join){
    return '<button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
    })
    ->make(true);
}*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('repairs.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'login' => 'required',
            'object_id' => 'required',
            'street' => 'required',
            'build' => 'required',
            'phone_num' => 'required',
            'vlan_name' => 'required',
            'cause' => 'required',
            'comment' => 'nullable'

        ]);
        // create repair
        $repair = new Repair;
        $repair->login = $request->input('login');
        $repair->object_id = $request->input('object_id');
        $repair->street = $request->input('street');
        $repair->build = $request->input('build');
        $repair->phone_num = $request->input('phone_num');
        $repair->vlan_name = $request->input('vlan_name');
        $repair->cause = $request->input('cause');
        $repair->comment = $request->input('comment');
        
        //$repair->user_id = auth()->user()->id;
        $repair->save();

        return redirect('/repairs')->with('success', 'Post Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
