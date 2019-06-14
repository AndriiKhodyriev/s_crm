<?php

namespace App\Http\Controllers;

use App\Order;
use App\User;
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
            $orders = Order::where('city_id', $cities)->orderBy('id','desc')->get();
            return view('supply.index')->with(['orders' => $orders, 'user_role' => $user->role_id]); //Вернуть только заказы которые на текущие объекты 
        } else { 
            return view('supply.index')->with(['user_role' => $user->role_id]); //Вернуть все заказы по всем городам 
        }
    }
}
