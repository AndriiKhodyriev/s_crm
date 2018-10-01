<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repair;
use App\City;
use App\TicketStatus;
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
        $statuses = TicketStatus::all();
        $cities = City::all();
        return view('repairs.index')->with(['cities' => $cities, 'statuses' => $statuses]);
    }

    public function datablesAllRepairs()
    {
        $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment', 
                                'ticket_status_id', 'created_at'])
                          ->where('ticket_status_id', '!=', 3)->get();
        return Datatables::of($repairs)
                            ->addColumn('city_name', function($repair){
                                return $repair->city->name;
                            })
                            ->addColumn('status_name', function($repair){
                                return $repair->ticketstatus->name;
                            })
                            ->addColumn('action', function($repair){
                                return '<button type="button" name="update" id='.$repair->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                            })
                            ->make(true);
    }

    public function datablesRepairFindById(Request $request)
    {
        $id = $request->id;
        $repair = Repair::find($id);
        return response()->json($repair);
    }

    public function datatablesRepairsFindByTicId($id){
        $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                                'created_at', 'ticket_status_id'])
                          ->where('ticket_status_id', '=', $id)->get();
        return Datatables::of($repairs)
                            ->addColumn('city_name', function($repair){
                                return $repair->city->name;
                            })
                            ->addColumn('status_name', function($repair){
                                return $repair->ticketstatus->name;
                            })
                            ->addColumn('action', function($repair){
                                return '<button type="button" name="update" id='.$repair->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                            })
                            ->make(true);
    }

    public function datatablesRepairCityId($id) {
        if ($id == 0){
            $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                                'created_at', 'ticket_status_id'])
                        ->where('ticket_status_id', '!=', 3)->get();
        } else {
            $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                                'created_at', 'ticket_status_id'])
                          ->where('city_id', '=', $id)
                          ->where('ticket_status_id','!=',3)->get();
        }
        
        return Datatables::of($repairs)
                            ->addColumn('city_name', function($repair){
                                return $repair->city->name;
                            })
                            ->addColumn('status_name', function($repair){
                                return $repair->ticketstatus->name;
                            })
                            ->addColumn('action', function($repair){
                                return '<button type="button" name="update" id='.$repair->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
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
            'city_name' => 'required',
            'street' => 'required',
            'build' => 'required',
            'phone_num' => 'required',
            'vlan_name' => 'required',
            'cause' => 'required',
            'comment' => 'nullable'

        ]);
        // create repair 
        $values = Repair::select(['id', 'ticket_status_id', 'login'])
                        ->where('login','=',$request->input('login'))
                        ->where('city_id','=',$request->input('city_name'))
                        ->where('ticket_status_id','!=', 3)->get();
        if ($values->count() >= 1){
            foreach($values as $val){
                $id = $val->id;
            }
        return redirect('/repairs')->with('error', 'Уже имеется открытая заявка! Номер заявки: '.$id);
        } else {
            $repair                     = new Repair;
            $repair->login              = $request->input('login');
            $repair->city_id            = $request->input('city_name');
            $repair->street             = $request->input('street');
            $repair->build              = $request->input('build');
            $repair->phone_num          = $request->input('phone_num');
            $repair->vlan_name          = $request->input('vlan_name');
            $repair->cause              = $request->input('cause');
            $repair->comment            = $request->input('comment');
            $repair->ticket_status_id   = 1;
            $repair->save();

            return redirect('/repairs')->with('success', 'Заявка составлена');
        }
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
            'login' => 'required',
            'street' => 'required',
            'build' => 'required',
            'phone_num' => 'required',
            'vlan_name' => 'required',
            'cause' => 'required',
            'comment' => 'nullable'

        ]);
        // create repair
        $repair = Repair::find($id);
        if ($request->input('status_name') != 0) {
            $repair->ticket_status_id = $requers->input('status_name');
        }
        if ($request->input('city_name') != 0) {
            $repair->city_id = $request->input('city_name');
        }
        $repair->login = $request->input('login');
        $repair->street = $request->input('street');
        $repair->build = $request->input('build');
        $repair->phone_num = $request->input('phone_num');
        $repair->vlan_name = $request->input('vlan_name');
        $repair->cause = $request->input('cause');
        $repair->comment = $request->input('comment');
        $repair->save();

        return redirect('/repairs')->with('success', 'Заявка на ремонт обновлена!');
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
