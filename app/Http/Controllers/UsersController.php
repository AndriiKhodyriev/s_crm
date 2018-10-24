<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function index() { 
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('users.index')->with('users', $users);
    }

    public function getUser(Request $request) { 
        $id = $request->id;
        $user = User::find($id);
        $data['user'] = $user;
        $cities = $user->cities;
        $i = 0;
        foreach($cities as $d) {
            $data[$i] = $d->id;
            $i++;
        }
        $data['count_cities'] = $i;
        return response()->json($data);
    }

    public function update(Request $request, $id) {
        $this->validate($request, [
            'full_name' => 'required',
            'phone_num' => 'required',
        ]);

        $user = User::find($id);
        $user->fullname = $request->input('full_name');
        $user->phone_num = $request->input('phone_num');
        $user->role_id = $request->input('role');
        $cityVal = $request->input('city');
        if (isset($cityVal)) {
            $user->cities()->detach();
        }
        if (isset($cityVal)) {
            $user->cities()->attach($cityVal);
        }
        $user->save();
        return redirect('/users')->with('success', 'Пользователь изменен!');

    }

    public function store(Request $request){
        $this->validate($request, [
            'login' => 'required',
            'name' => 'required',
            'phone' => 'required',
        ]);
        $user = new User();

        $user->username = $request->input('login');
        $user->role_id = $request->input('role');
        $user->fullname = $request->input('name');
        $user->phone_num = $request->input('phone');
        $user->password = bcrypt($request->input('password'));
        $user->save();
        redirect('/');
        return redirect('/users')->with('success', 'Пользователь создан!');
    }
}
