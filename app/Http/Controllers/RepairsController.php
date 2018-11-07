<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Repair;
use App\City;
use App\User;
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
        return view('repairs.index')->with(['cities' => $cities, 'statuses' => $statuses]);
    }

    public function datablesAllRepairs(Request $request)
    {
        $user = $request->user();
        

        if ($user->hasRole('grunt')) {
            $cities = [];
            foreach ($user->cities as $city) {
                array_push($cities, $city->id);
            };
            $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment', 
                                'ticket_status_id', 'created_at','create_user_id'])
                          ->where('ticket_status_id', '!=', 3)
                          ->whereIn('city_id', $cities)
                          ->get();
        } else {
            $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment', 
                                'ticket_status_id', 'created_at','create_user_id'])
                          ->where('ticket_status_id', '!=', 3)
                          ->get();
        };    
        
        return Datatables::of($repairs)
                            ->addColumn('city_name', function($repair){
                                return $repair->city->name;
                            })
                            ->addColumn('status_name', function($repair){
                                if($repair->ticket_status_id == 1) { 
                                    return '<span class="label label-info">' .  $repair->ticketstatus->name . '</span>';
                                } else {
                                    return '<span class="label label-warning">' .  $repair->ticketstatus->name . '</span>';
                                }
                            })
                            ->addColumn('date_action', function($repair){
                                return '<span class="label label-info">' .  $repair->created_at . '</span>';
                            })
                            ->addColumn('user_name', function($repair){
                                return '<span class="label label-info">' .  User::find($repair->create_user_id)->fullname . '</span>';
                            })
                            ->addColumn('action', function($repair){
                                if(auth()->user()->role_id == 1 OR auth()->user()->role_id == 2) {
                                return '<form method="post" action="/repairs/'.$repair->id.'">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="form-group">
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <button type="submit" class="label label-important">Удалить</button></form>
                                        <button type="button" name="update" id='.$repair->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                                } else {
                                    return '<button type="button" name="update" id='.$repair->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                                }
                            })
                            ->make(true);
    }

    public function datablesRepairFindById(Request $request)
    {
        $id = $request->id;
        $repair = Repair::find($id);
        return response()->json($repair);
    }

    public function datatablesRepairsFindByTicId(Request $request, $id){
        $user = $request->user();
        

        if ($user->hasRole('grunt')) {
            $cities = [];
            foreach ($user->cities as $city) {
                array_push($cities, $city->id);
            };
            $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                                'created_at', 'ticket_status_id', 'create_user_id', 'close_user_id', 'updated_at'])
                          ->where('ticket_status_id', '=', $id)
                          ->whereIn('city_id', $cities)
                          ->get();
        } else {
            $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                                'created_at', 'ticket_status_id', 'create_user_id', 'close_user_id', 'updated_at'])
                          ->where('ticket_status_id', '=', $id)->get();
        }    

        
        return Datatables::of($repairs)
                            ->addColumn('city_name', function($repair){
                                return $repair->city->name;
                            })
                            ->addColumn('status_name', function($repair){
                                if($repair->ticket_status_id == 1) {
                                    return '<span class="label label-info">' .  $repair->ticketstatus->name . '</span>';
                                } elseif($repair->ticket_status_id == 2) {
                                    return '<span class="label label-warning">' .  $repair->ticketstatus->name . '</span>';
                                } elseif ($repair->ticket_status_id == 3) {
                                    return '<span class="label label-important">' .  $repair->ticketstatus->name . '</span>';
                                } else {

                                }
                                return $repair->ticketstatus->name;
                            })
                            ->addColumn('date_action', function($repair){
                                if($repair->ticket_status_id == 3) {
                                    return '<span class="label label-important">' .  $repair->updated_at . '</span>';
                                } else { 
                                    return '<span class="label label-info">' .  $repair->created_at . '</span>';
                                }
                            })
                            ->addColumn('user_name', function($repair){
                                if($repair->ticket_status_id == 3) {
                                    return '<span class="label label-important">' .  User::find($repair->close_user_id)->fullname . '</span>';
                                } else { 
                                    return '<span class="label label-info">' .  User::find($repair->create_user_id)->fullname . '</span>';
                                }   
                            })
                            ->addColumn('action', function($repair){
                                if(auth()->user()->role_id == 1 OR auth()->user()->role_id == 2) {
                                return '<form method="post" action="/repairs/'.$repair->id.'">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="form-group">
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <button type="submit" class="label label-important">Удалить</button></form>
                                        <button type="button" name="update" id='.$repair->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                                } else {
                                    return '<button type="button" name="update" id='.$repair->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                                }
                            })
                            ->make(true);
    }

    public function datatablesRepairCityId(Request $request, $id) {
        $user = $request->user();
        if ($id == 0){
            
            if ($user->hasRole('grunt')) {
                $cities = [];
                foreach ($user->cities as $city) {
                    array_push($cities, $city->id);
                };

                $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                                'created_at', 'ticket_status_id','create_user_id', 'created_at'])
                        ->where('ticket_status_id', '!=', 3)
                        ->whereIn('city_id', $cities)
                        ->get();
                
             } else {
               

               $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                                'created_at', 'ticket_status_id','create_user_id', 'created_at'])
                        ->where('ticket_status_id', '!=', 3)->get();
             }   
        } else {
            if ($user->hasRole('grunt')) {
                $cities = [];
                foreach ($user->cities as $city) {
                    array_push($cities, $city->id);
                };
                $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                                'created_at', 'ticket_status_id', 'create_user_id', 'created_at'])
                          ->where('city_id', '=', $id)
                          ->where('ticket_status_id','!=',3)
                          ->whereIn('city_id', $cities)
                          ->get();
            } else {
                
                $repairs = Repair::select(['id', 'login', 'city_id', 'street', 'build', 'vlan_name', 'phone_num','cause', 'comment', 'comment',
                                'created_at', 'ticket_status_id', 'create_user_id', 'created_at'])
                          ->where('city_id', '=', $id)
                          ->where('ticket_status_id','!=',3)->get();
            }
        }
        
        return Datatables::of($repairs)
                            ->addColumn('city_name', function($repair){
                                return $repair->city->name;
                            })
                            ->addColumn('date_action', function($repair){
                                return '<span class="label label-info">' .  $repair->created_at . '</span>';
                            })
                            ->addColumn('status_name', function($repair){
                                return '<span class="label label-info">' .  $repair->ticketstatus->name . '</span>';
                            })
                            ->addColumn('user_name', function($repair){
                                return '<span class="label label-info">' .  User::find($repair->create_user_id)->fullname . '</span>';
                            })
                            ->addColumn('action', function($repair){
                                if(auth()->user()->role_id == 1 OR auth()->user()->role_id == 2) {
                                return '<form method="post" action="/repairs/'.$repair->id.'">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="form-group">
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <button type="submit" class="label label-important">Удалить</button></form>
                                        <button type="button" name="update" id='.$repair->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                                } else {
                                    return '<button type="button" name="update" id='.$repair->id.' class="btn btn-warning btn-xs update" >Изменить</button>';
                                }
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
        
        //get user id
        $userId = Auth::id();   
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
            $repair->create_user_id   = $userId;
            $repair->close_user_id   = $userId;
            $login = "#" . $request->input('login');
            $repair->save();
            $city = City::find($request->input('city_name'));
            $chat_id = $city->chat_id;
            $text = "ЗАЯВКА НА РЕМОНТ!\r\n \r\n Адресс: " . $request->input('street') . " Дом : " . $request->input('build')
                    . "\r\n Телефон : "     . $request->input('phone_num') 
                    . "\r\n ЛОГИН : "       . $login
                    . "\r\n VLAN : "        . $request->input('vlan_name') 
                    . "\r\n Причина : "     . $request->input('cause')
                    . "\r\n Комментарий : " . $request->input('comment');
            sendMessage($text, $chat_id);
            return redirect('/repairs')->with('success', 'Заявка составлена! Сообщение отправленно!');
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
        //get user id
        $userId = Auth::id(); 
        // create repair
        $repair = Repair::find($id);
        if ($request->input('status_name') != 0) {
            $repair->ticket_status_id = $request->input('status_name');
            if($request->input('status_name') == 3){
                $repair->close_user_id = $userId;
            }
        }
        if ($request->input('city_name') != 0) {
            $repair->city_id = $request->input('city_name');
        }
        $repair->login              = $request->input('login');
        $repair->street             = $request->input('street');
        $repair->build              = $request->input('build');
        $repair->phone_num          = $request->input('phone_num');
        $repair->vlan_name          = $request->input('vlan_name');
        $repair->cause              = $request->input('cause');
        $repair->comment            = $request->input('comment');
        $repair->save();
        $city = City::find($repair->city_id);
        $chat_id = $city->chat_id;
        $text = "ЗАЯВКА НА РЕМОНТ!\r\n \r\n Адресс: " . $request->input('street') . " Дом : " . $request->input('build')
                . "\r\n Телефон : "     . $request->input('phone_num') 
                . "\r\n ЛОГИН : "       . $login
                . "\r\n VLAN : "        . $request->input('vlan_name') 
                . "\r\n Причина : "     . $request->input('cause')
                . "\r\n Комментарий : " . $request->input('comment');
        sendMessage($text, $chat_id);
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
        $repair = Repair::find($id);
        $repair->delete();
        return redirect('/repairs')->with('success', 'Заявка на ремонт УДАЛЕНА!');
    }
}
