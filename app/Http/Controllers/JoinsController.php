<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Join;
use App\City;
use App\User;
use App\TicketStatus;
use Datatables;
use DB;

class JoinsController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $user = $request->user();
        

        if ($user->hasRole('grunt')) {
            $cities_id = [];
            foreach ($user->cities as $city) {
                array_push($cities_id, $city->id);
            };
        //$cities = City::all();
            $cities = City::select(['id','name'])
                    ->whereIn('id', $cities_id)
                    ->get();
        } else {
            $cities = City::all();
        }            
        $statuses = TicketStatus::all();
        return view('joins.index')->with(['cities' => $cities, 'statuses' => $statuses]);
        
    }
    public function datablesAllJoins(Request $request)
    { 
        $user = $request->user();
        

        if ($user->hasRole('grunt')) {
            $cities = [];
            foreach ($user->cities as $city) {
                array_push($cities, $city->id);
            };
            $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment', 
                            'close_user_id', 'create_user_id', 'join_area'])
                        ->where('ticket_status_id', '!=', 3)
                        ->whereIn('city_id', $cities)
                        ->get();
        } else {
            $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment', 
                            'close_user_id', 'create_user_id', 'join_area'])
                        ->where('ticket_status_id', '!=', 3)
                        ->get();
        };
        return Datatables::of($joins)
                            ->addColumn('city_name', function($join){
                                 return $join->city->name;
                            })
                            ->addColumn('status_name', function($join){
                                if($join->ticket_status_id == 1) {
                                    return '<span class="label label-info">' . $join->ticketstatus->name . '</span>';
                                } elseif ($join->ticket_status_id == 2) {
                                    return '<span class="label label-warning">' . $join->ticketstatus->name . '</span>';
                                } else {
                                    return '<span class="label">' . $join->ticketstatus->name . '</span>';
                                }
                            })
                            ->addColumn('date_action', function($join){
                                    return '<span class="label label-info">' .$join->created_at. '</span>';   
                            })
                            ->addColumn('user_name', function($join){
                                return '<span class="label label-info">' . User::find($join->create_user_id)->username . '</span>';
                            })
                            ->addColumn('join_area', function($join){
                                if($join->join_area == NULL) {
                                    return '<span class="label label-important"> Место не установленно</span>';
                                } else {
                                    return '<span class="label label-info">' . $join->join_area . '</span>';
                                }
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

    public function datatablesFindByTicketStatusId(Request $request, $id){ 
        
        //print_r($user);
        $user = $request->user();
        

        if ($user->hasRole('grunt')) {
            $cities = [];
            foreach ($user->cities as $city) {
                array_push($cities, $city->id);
            };
            $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                'close_user_id', 'create_user_id', 'join_area', 'updated_at'])
                            
                            ->where('ticket_status_id', '=', $id)
                            ->whereIn('city_id', $cities)
                            ->get();
        } else {
            $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                    'close_user_id', 'create_user_id', 'join_area', 'updated_at'])
                                
                                ->where('ticket_status_id', '=', $id)
                                ->get();
                };                
            return Datatables::of($joins)
                            ->addColumn('city_name', function($join){
                                    return $join->city->name;
                            })
                            ->addColumn('status_name', function($join){
                                if($join->ticket_status_id == 1) {
                                    return '<span class="label label-info">' . $join->ticketstatus->name . '</span>';
                                } elseif ($join->ticket_status_id == 2) {
                                    return '<span class="label label-warning">' . $join->ticketstatus->name . '</span>';
                                } elseif ($join->ticket_status_id == 3) {
                                    return '<span class="label label-important">' . $join->ticketstatus->name . '</span>';
                                }
                            })
                            ->addColumn('date_action', function($join){
                                if($join->ticket_status_id == 3) {
                                    return '<span class="label label-important">' . $join->updated_at . '</span>';
                                } else {
                                    return '<span class="label label-info">' . $join->created_at . '</span>';
                                }
                            })
                            ->addColumn('user_name', function($join){
                                if($join->ticket_status_id == 3) {
                                    return '<span class="label label-important">' . User::find($join->close_user_id)->username . '</span>';
                                } else {
                                    return '<span class="label label-info">' . User::find($join->create_user_id)->username . '</span>';
                                }
                            })
                            ->addColumn('join_area', function($join){
                                if($join->join_area == NULL) {
                                    return '<span class="label label-important"> Место не установленно</span>';
                                } else {
                                    return '<span class="label label-info">' . $join->join_area . '</span>';
                                }
                            })
                            ->addColumn('action', function($join){
                                return '<button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                            })
                            ->make(true);
    }
    public function datatablesFindByCityId($id){
        if($id == 0){
            $user = $request->user();
        

            if ($user->hasRole('grunt')) {
                $cities = [];
                foreach ($user->cities as $city) {
                    array_push($cities, $city->id);
                };

                $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                'close_user_id', 'create_user_id', 'join_area'])
                            ->where('ticket_status_id', '!=', 3)
                            ->whereIn('city_id', $cities)
                            ->get();
            } else {
                $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                'close_user_id', 'create_user_id', 'join_area'])
                            ->where('ticket_status_id', '!=', 3)
                            ->get();
            }                
        } else {
            $user = $request->user();
        

            if ($user->hasRole('grunt')) {
                $cities = [];
                foreach ($user->cities as $city) {
                    array_push($cities, $city->id);
                };

                $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                'close_user_id', 'create_user_id', 'join_area'])
                            ->where('city_id','=', $id)
                            ->where('ticket_status_id', '!=', 3)
                            ->whereIn('city_id', $cities)
                            ->get();
            } else {
                $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                'close_user_id', 'create_user_id', 'join_area'])
                            ->where('city_id','=', $id)
                            ->where('ticket_status_id', '!=', 3)
                            ->get();
            }
        }

        return Datatables::of($joins)
                            ->addColumn('city_name', function($join){
                                return $join->city->name;
                            })
                            ->addColumn('status_name', function($join){
                                if($join->ticket_status_id == 1) {
                                    return '<span class="label label-info">' . $join->ticketstatus->name . '</span>';
                                } elseif ($join->ticket_status_id == 2) {
                                    return '<span class="label label-warning">' . $join->ticketstatus->name . '</span>';
                                } elseif ($join->ticket_status_id == 3) {
                                    return '<span class="label label-important">' . $join->ticketstatus->name . '</span>';
                                }
                            })
                            ->addColumn('date_action', function($join){
                                return '<span class="label label-info">' . $join->created_at . '</span>';
                            })
                            ->addColumn('user_name', function($join){
                                return '<span class="label label-info">' . User::find($join->create_user_id)->username . '</span>';
                            })
                            ->addColumn('join_area', function($join){
                                if($join->join_area == NULL) {
                                    return '<span class="label label-important"> Место не установленно</span>';
                                } else {
                                    return '<span class="label label-info">' . $join->join_area . '</span>';
                                }
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
            'city_name' => 'required',
            'street'    => 'required',
            'build'     => 'required',
            'full_name' => 'required',
            'phone_num' => 'required',
        ]);
         //get user id
         $userId = Auth::id();   
         //create post 
         $joins                     = new Join;
         $joins->city_id            = $request->input('city_name');
         $joins->street             = $request->input('street');
         $joins->build              = $request->input('build');
         $joins->full_name          = $request->input('full_name');
         $joins->phone_num          = $request->input('phone_num');
         $joins->comment            = $request->input('comment');
         $joins->ticket_status_id   = 1;
         $joins->create_user_id     = $userId;
         $joins->close_user_id      = $userId;

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
            'street'    => 'required',
            'build'     => 'required',
            'full_name' => 'required',
            'phone_num' => 'required',
        ]);
        
        //get user id
        $userId = Auth::id();   
        //$userId = 1;   
        
        $join                     = Join::find($id);
            if ($request->input('status_name') != 0) {
                $join->ticket_status_id   = $request->input('status_name');
                if($request->input('status_name') == 3) {
                    $join->close_user_id = $userId;
                }
            }
            if ($request->input('city_name') != 0) { 
                $join->city_id   = $request->input('city_name');
            }

        $join->street             = $request->input('street');
        $join->build              = $request->input('build');
        $join->full_name          = $request->input('full_name');
        $join->phone_num          = $request->input('phone_num');
        $join->comment            = $request->input('comment');
        $join->join_area          = $request->input('join_area');
        $join->save();
        return redirect('/joins')->with('success', 'Заявка на подключение обновлена!');

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