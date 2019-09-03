<?php

namespace App\Http\Controllers;

use App\Order;
use App\Item;
use App\User;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplyController extends Controller
{
    //
    public function index() 
    {
        $user = User::find(Auth::id());
        if($user->role_id == 4 ) {
            $cities = [];
            foreach ($user->cities as $city) {
                array_push($cities, $city->id);
            };
            $citiesNames = City::whereIn('id', $cities)->get();
            $orders = Order::whereIn('city_id', $cities)->orderBy('id','desc')->get();
            return view('supply.index')->with(['orders' => $orders, 'user_role' => $user->role_id, 'cities' => $citiesNames]); //Вернуть только заказы которые на текущие объекты 
        } else { 
            return view('supply.index')->with(['user_role' => $user->role_id, 'cities' => City::select('id', 'name')->get()]); //Вернуть все заказы по всем городам 
        }
    }

    public function store(Request $request)
    {
        //Так как кол-во полей изначально неизвестно - необходимо искать их кол-во! 
        //В реквесте есть 2 поля (токен и сити_ИД) - эти поля всегда в одном экземпляре 
        $count = (count($request->all()) - 2);
        //Таким образом мы получим нужно кол-во полей которые необходимо обработать 
        //Кол-во полей кратное трем
        $count = $count/3;
        //Имена всех : (item_name-Х count-Х и description-Х) - где Х генерируется при добавления поля (отсчет начинается с 1)
        if ($request->input('city_name') == 0) {
            return redirect('/supply')->with('error', 'Не создано! Указать город!');
        } else { 
            $orderNew = new Order;
            $orderNew->city_id = $request->input('city_name');
            $orderNew->user_id = Auth::id();
            $orderNew->status_id = 1;
            $orderNew->provider_id = 0;
            $orderNew->price = 0;
            $orderNew->currency_id = 1;
            $orderNew->waybill = 0; 
            $orderNew->save();
            if($count == 1) {
                $this->validate($request, [
                    'item_name-1'       => 'required',
                    'count-1'           => 'required',
                    'description-1'     => 'required',
                ]);
                $item = new Item;
                $item->order_id = $orderNew->id;
                $item->item_name = $request->input('item_name-1');
                $item->count = $request->input('count-1');
                $item->desctiption = $request->input('description-1');
                $item->save();
            return redirect('/supply')->with('error', 'Создан новый заказ!');
            } else { 
                $counter = 1;
                while($counter <= $count) {
                    $item = new Item;
                    $item->order_id = $orderNew->id;
                    $item->item_name = $request->input('item_name-'.$counter);
                    $item->count = $request->input('count-'.$counter);
                    $item->desctiption = $request->input('description-'.$counter);
                    $item->save();
                    $counter++;
                }
            return redirect('/supply')->with('error', 'Создан новый заказ!');
            }
        }
        
        echo($orderNew->id);
    }
}
