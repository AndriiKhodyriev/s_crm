<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Join;
use App\City;
use App\User;
use App\JoinsLog;
use App\Moduls\Telegram;
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
            $cities = City::select(['id','name', 'visibility_everywhere'])
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
                                    $date = $join->created_at;
                                    return '<span class="label label-info">' . date("d-m-Y H:i:s", strtotime($date)) . '</span>';   
                            })
                            ->addColumn('user_name', function($join){
                                return '<span class="label label-info">' . User::find($join->create_user_id)->fullname . '</span>';
                            })
                            ->addColumn('join_area', function($join){
                                if($join->join_area == NULL) {
                                    return '<span class="label label-important"> НЕТ </span>';
                                } else {
                                    return '<span class="label label-info">' . $join->join_area . '</span>';
                                }
                            })
                            ->addColumn('action', function($join){
                                if(auth()->user()->role_id == 1 OR auth()->user()->role_id == 2) {
                                return '<form method="post" action="/joins/'.$join->id.'">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="form-group">
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <button type="submit" class="label label-important">Удалить</button></form>
                                        <button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>
                                        <i class="entypo-info" id='.$join->id.'></i>';
                                } else {
                                    return '<button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>
                                    <i class="entypo-info" id='.$join->id.'></i>';
                                }
                            })
                            ->make(true);
    }
    public function datablesFindById(Request $request){ 
        $id = $request->id;
        $join = Join::find($id);
        return response()->json($join);
    }

    public function datatablesFindByTicketStatusId(Request $request, $id, $cityID){ 
        
        //print_r($user);
        $user = $request->user();
        if ($user->hasRole('grunt')) {
            $cities = [];
            foreach ($user->cities as $city) {
                array_push($cities, $city->id);
            };
            if($id == 0) {
                $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                'close_user_id', 'create_user_id', 'join_area', 'updated_at'])
                            ->where('city_id', $cities)
                            ->get();
            } else {
                $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                'close_user_id', 'create_user_id', 'join_area', 'updated_at'])
                            ->where('ticket_status_id', '=', $id)
                            ->whereIn('city_id', $cities)
                            ->get();
            };
        } else {
            if($id == 0) {
                if ($cityID == 0) {
                    $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                    'close_user_id', 'create_user_id', 'join_area', 'updated_at'])
                                ->get();
                } else {
                    $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                         'close_user_id', 'create_user_id', 'join_area', 'updated_at'])
                                    ->where('city_id', '=', $cityID)
                                    ->get();

                }
            } else {
                if ($cityID == 0) {
                    $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                        'close_user_id', 'create_user_id', 'join_area', 'updated_at'])
                                    ->where('ticket_status_id', '=', $id)
                                    ->get();
                } else { 
                    $joins = Join::select(['id', 'city_id', 'street', 'build', 'full_name', 'phone_num', 'created_at', 'ticket_status_id', 'comment',
                                        'close_user_id', 'create_user_id', 'join_area', 'updated_at'])
                                    ->where('city_id', '=', $cityID)
                                    ->where('ticket_status_id', '=', $id)
                                    ->get();
                }
                
            };
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
                                } elseif ($join->ticket_status_id == 4) {
                                    return '<span class="label label-important">' . $join->ticketstatus->name . '</span>';
                                }
                            })
                            ->addColumn('date_action', function($join){
                                if($join->ticket_status_id == 3) {
                                    $date = $join->updated_at;
                                    return '<span class="label label-important">' . date("d-m-Y H:i:s", strtotime($date)) . '</span>';
                                } else {
                                    $date = $join->created_at;
                                    return '<span class="label label-info">' . date("d-m-Y H:i:s", strtotime($date)) . '</span>';
                                }
                            })
                            ->addColumn('user_name', function($join){
                                if($join->ticket_status_id == 3) {
                                    return '<span class="label label-important">' . User::find($join->close_user_id)->fullname . '</span>';
                                } else {
                                    return '<span class="label label-info">' . User::find($join->create_user_id)->fullname . '</span>';
                                }
                            })
                            ->addColumn('join_area', function($join){
                                if($join->join_area == NULL) {
                                    return '<span class="label label-important"> НЕТ </span>';
                                } else {
                                    return '<span class="label label-info">' . $join->join_area . '</span>';
                                }
                            })
                            ->addColumn('action', function($join){
                                if(auth()->user()->role_id == 1 OR auth()->user()->role_id == 2) {
                                return '<form method="post" action="/joins/'.$join->id.'">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="form-group">
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <button type="submit" class="label label-important">Удалить</button></form>
                                        <button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>
                                        <i class="entypo-info" id='.$join->id.'></i>';
                                } else {
                                    return '<button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>
                                    <i class="entypo-info" id='.$join->id.'></i>';
                                }
                            })
                            ->make(true);
    }
    public function datatablesFindByCityId(Request $request, $id){
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
                                } elseif ($join->ticket_status_id == 4) {
                                    return '<span class="label label-important">' . $join->ticketstatus->name . '</span>';
                                }
                            })
                            ->addColumn('date_action', function($join){
                                $date = $join->created_at;
                                return '<span class="label label-info">' . date("d-m-Y H:i:s", strtotime($date)) . '</span>';
                            })
                            ->addColumn('user_name', function($join){
                                return '<span class="label label-info">' . User::find($join->create_user_id)->fullname . '</span>';
                            })
                            ->addColumn('join_area', function($join){
                                if($join->join_area == NULL) {
                                    return '<span class="label label-important"> НЕТ</span>';
                                } else {
                                    return '<span class="label label-info">' . $join->join_area . '</span>';
                                }
                            })
                            ->addColumn('action', function($join){
                                if(auth()->user()->role_id == 1 OR auth()->user()->role_id == 2) {
                                return '<form method="post" action="/joins/'.$join->id.'">
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="form-group">
                                        <input type="hidden" name="_token" value="'.csrf_token().'">
                                        <button type="submit" class="label label-important">Удалить</button></form>
                                        <button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>
                                        <i class="entypo-info" id='.$join->id.'></i>';
                                } else {
                                    return '<button type="button" name="update" id='.$join->id.' class="btn btn-warning btn-xs update" >Изменить</button>
                                    <i class="entypo-info" id='.$join->id.'></i>';
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
        if ($request->input('city_name') == 0) {
            return redirect('/joins')->with('error', 'Не создано! Указать город!');
        } else {
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
         $city = City::find($request->input('city_name'));
         $chat_id = $city->chat_id;
         $text = "ЗАЯВКА НА ПОДКЛЮЧЕНИЕ!\r\n \r\n Адресс: " . $request->input('street') . " Дом : " . $request->input('build')
                . "\r\n Телефон : " . $request->input('phone_num') 
                . "\r\n ФИО : " . $request->input('full_name') 
                . "\r\n Комментарий : " . $request->input('comment');
         sendMessage($text, $chat_id);
         log_create_join($userId, $joins->id);
         return redirect('/joins')->with('success', 'Заявка сформирована! Сообщение было отправленно! ');
        }
        
    }
    // обработчик для создания заявок которые приходят от клиентов 
    // заявки приходят постом с внешнего сайта 
    // редиректы не использовать 
    // все заявки который получаем таким способом идут от пользователя с ID = 32 
    // все заявки которые получаем таким способом (БЕЗ ГОРОДА city_name = 01740169)   будет присвоен город НЕИЗВЕСТНО с ID = 24
    // все заявки которые получаем таким способом получают ticket_status_id = 4 (С САЙТА)

    public function joinsClients(Request $request)
    {
        $this->validate($request, [
            'city_name' => 'required',
            'street'    => 'required',
            'build'     => 'required',
            'full_name' => 'required',
            'phone_num' => 'required',
        ]);
        
        $join                       = new Join;
        $join->street              = $request->input('street');
        $join->build               = $request->input('build');
        $join->full_name           = $request->input('full_name');
        $join->phone_num           = $request->input('phone_num');
        $join->street              = $request->input('street');
        $join->build               = $request->input('build');
        $join->full_name           = $request->input('full_name');
        $join->phone_num           = $request->input('phone_num');
        $join->create_user_id       = 32;
        $join->close_user_id        = 32;
        if( $request->input('city_name') == 11111 ) {
            $join->city_id          = 24;
        } else {
            $join->city_id          = $request->input('city_name');
        }
        $join->ticket_status_id     = 4;
        $join->save();
        return redirect()->away('http://kronos.in.ua/');
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

                //После сохранения логируем данные
                log_modif_join($join, $request, $userId);
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

        $city = City::find($join->city_id);
        if ($request->input('status_name') != 3) {
            $chat_id = $city->chat_id;
             $text = "ЗАЯВКА НА ПОДКЛЮЧЕНИЕ ОБНОВЛЕНА!\r\n \r\n Адресс: " . $request->input('street') . " Дом : " . $request->input('build')
                . "\r\n Телефон : " . $request->input('phone_num') 
                . "\r\n ФИО : " . $request->input('full_name') 
                . "\r\n Комментарий : " . $request->input('comment');
            sendMessage($text, $chat_id);
        }
        
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
        $join = Join::find($id);
        $join->delete();
        return redirect('/joins')->with('success', 'Заявка на подключение УДАЛЕНА!');
    }

    //Функция которая отдает все логи по �
    //�пределенной заявке 
    public function logJoin(Request $request){
        $id = $request->id;
        $logs = DB::table('joins_logs')->select([
            'joins_logs.id',
            'joins_logs.join_id',
            'joins_logs.info_log',
            'joins_logs.created_at',
            'users.fullname',
        ])
        ->leftJoin('users', 'users.id', '=', 'joins_logs.user_id')
        ->where('joins_logs.join_id', '=', $id)
        ->orderBy('joins_logs.id', 'desc')
        ->get();
        //$logs = JoinsLog::where('join_id', $request->id)->orderBy('id','desc')->get();
        
        return response()->json($logs); 
    }
}
