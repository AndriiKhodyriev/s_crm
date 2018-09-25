<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Join;
use Datatables;
use DB;

class JoinsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         return view('joins.index');
        
    }
    public function datablesAllJoins(){ 
        $joins = Join::where('ticket_status_id', '!=', 3)->orderBy('id','DESC');
        return Datatables::of($joins)
                            ->addColumn('status_name', function($join){
                                return $join->ticketstatus->name;
                            })
                            ->addColumn('action', function($join){
                                return '<button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                            })
                            ->make(true);
    }
    public function datablesFindById(Request $request){ 
        $id = $request->id;
        $join = Join::find($id);
        return response()->json($join);
    }

    public function datatablesFindByTicketStatusId($id){ 
         $joins = Join::where('ticket_status_id', '=', $id)->orderBy('id','DESC');

        return Datatables::of($joins)
                            ->addColumn('status_name', function($join){
                                return $join->ticketstatus->name;
                            })
                            ->addColumn('action', function($join){
                                return '<button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                            })
                            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('joins.create');
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
            'street' => 'required',
            'build' => 'required',
            'full_name' => 'required',
            'phone_num' => 'required',
        ]);

         //create post 
         $joins                     = new Join;
         $joins->street             = $request->input('street');
         $joins->build              = $request->input('build');
         $joins->full_name          = $request->input('full_name');
         $joins->phone_num          = $request->input('phone_num');
         $joins->comment            = $request->input('comment');
         $joins->ticket_status_id   = 3;

         $joins->save();
         return redirect('/joins')->with('success', 'Заявка составлена');
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
        $this->validate($request, [
            'street' => 'required',
            'build' => 'required',
            'full_name' => 'required',
            'phone_num' => 'required',
        ]);
        $join                     = Join::find($id);
        $join->street             = $request->input('street');
        $join->build              = $request->input('build');
        $join->full_name          = $request->input('full_name');
        $join->phone_num          = $request->input('phone_num');
        $join->comment            = $request->input('comment');
        $join->ticket_status_id   = 3;
        $join->save();
        return redirect('/joins')->with('success', 'Измененно');

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