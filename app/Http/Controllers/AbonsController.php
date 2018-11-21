<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Abon;
use App\City;
use App\TConnection;
use Illuminate\Http\Request;
use App\Moduls\Query;
use App\Moduls\Func;

use Datatables;
use DB;

class AbonsController extends Controller
{
    //
    public function index() 
    {
        $abons = Abon::all();
        $cities = City::all();
        $t_connections = TConnection::all();
        return view('abons.index')->with(['abons' => $abons, 'cities' => $cities, 't_connections' => $t_connections]);
    }

    public function store(Request $request) {
        if ($request->input('city_name') == 0 ) {
            return redirect('/abons')->with('error', 'Клиент не создан! Не выбран город!');
        } else { 
            $userID = Auth::id();
            $abon = new Abon;
            $abon->create_user_id = $userID;
            // проверяем стандартные поля для всех типов подключения
            $this->validate($request, [
                'login'         => 'required',
                'tp_name'       => 'required',
                'password'      => 'required',
                'fullname'      => 'required',
                'phone_num'     => 'required',
                'street'        => 'required',
                'build'         => 'required',
                'all_money'     => 'required',
                'comment'       => 'required',
                'leng'          => 'required',                
            ]);
            $abon->login = $request->input('login');
            $abon->tarif_plan = $request->input('tp_name');
            $abon->password = $request->input('password');
            $abon->fullname = $request->input('fullname');
            $abon->phone = $request->input('phone_num');
            $abon->street = $request->input('street');
            $abon->build = $request->input('build');
            $abon->flat = $request->input('flat');
            $abon->all_money = $request->input('all_money');
            $abon->comment = $request->input('comment');
            $abon->leng = $request->input('leng');
            $abon->city_id = $request->input('city_name');
            $abon->t_connection_id = $request->input('t_connections');
            // если выбран тип подключения ПОН то проверить поля 
            if ($request->t_connections == 1) {
                $this->validate($request, [
                    'mac_onu'   => 'required',
                    'point_inc' => 'required',
                ]);
                $abon->mac_onu = $request->input('onu_mac');
                $abon->point_inc = $request->input('point_inc');
                $abon->save();
                return redirect('/abons')->with('success', 'Клиент успешно создан!');
            // если выбран  тип подключения WiFi то проверить поля
            } elseif ($request->t_conections == 2) {
                $this->validate($request, [
                    'base_ip'   => 'required',
                    'clien_ip'  => 'required',
                ]);
                $abon->base_ip = $request->input('base_ip');
                $abon->client_ip = $request->input('client_ip');
                $abon->save();
                return redirect('/abons')->with('success', 'Клиент успешно создан!');
            } elseif ($request->t_connections == 3) {
                $abon->save();
                return redirect('/abons')->with('success', 'Клиент успешно создан!');
            } else {
                return redirect('/abons')->with('error', 'Клиент не создан! Не указан тип подключения!');
            }
        }
    }
    public function update(Request $request, $id){
        $city_id = $request->input('city_name');
        $t_connection = $request->input('t_connections');

        $abon = Abon::find($id);

        $this->validate($request, [
            'street'    => 'required',
        ]);
        ($abon->login       != $request->input('login'))        ? $abon->login = $request->input('login') : "НЕТ ИЗМ";
        ($abon->tarif_plan  != $request->input('tp_name'))      ? $abon->tarif_plan = $request->input('tp_name') : "НЕТ ИЗМ";
        ($abon->password    != $request->input('password'))     ? $abon->password = $request->input('password') : "НЕТ ИЗМ";
        ($abon->fullname    != $request->input('fullname'))     ? $abon->fullname = $request->input('fullname') : "НЕТ ИЗМ";
        ($abon->phone       != $request->input('phone_num'))    ? $abon->phone = $request->input('phone_num') : "НЕТ ИЗМ";
        ($abon->street      != $request->input('street'))       ? $abon->street = $request->input('street') : "НЕТ ИЗМ";
        ($abon->build       != $request->input('build'))        ? $abon->build = $request->input('build') : "НЕТ ИЗМ";
        ($abon->flat        != $request->input('flat'))         ? $abon->flat = $request->input('flat') : "НЕТ ИЗМ";
        ($abon->all_money   != $request->input('all_money'))    ? $abon->all_money = $request->input('all_money') : "НЕТ ИЗМ";
        ($abon->comment     != $request->input('comment'))      ? $abon->comment = $request->input('comment') : "НЕТ ИЗМ";
        ($abon->leng        != $request->input('leng'))         ? $abon->leng = $request->input('leng') : "НЕТ ИЗМ";
        //($abon->city_id     != $request->input('city_name'))    ? $abon->city_id = $request->input('city_name') : "НЕТ ИЗМ";
        $abon->save();
        if ($city_id == 0) {
            if ($t_connection == 0) {
                if ($abon->t_connection_id == 1) {

                } elseif ($abon->t_connection_id == 2) {

                } elseif ($abon->t_connection_id == 3) {

                }
                return redirect('/abons')->with('error', 'ВСЕ ЗБС!!!!');
            } elseif ($t_connection == $abon->t_connection_id) {
                
            }
        } elseif ($t_connection == 0) {

        }
    }

    public function datatablesFindID(Request $request){ 
        $id = $request->id;
        $abon = Abon::find($id);
        return response()->json($abon);
    }


    public function datatablesFindCityIDBase(Request $request, $id, $type_con) { 
        $select_query = select_all_abons(); //выбираем всех абонов (часто используется App\QueryModule)
        if ($type_con == 0) {
            if ($id == 0) {
                $abons = $select_query;
            } else { 
                $abons = $select_query->where('city_id', $id);
            }
        } else {
            if ($id == 0) {
                $abons = $select_query->where('t_connection_id', $type_con);
            } else { 
                $abons = $select_query->where('city_id', $id)->where('t_connection_id', $type_con);
            }
        }
        //Делаем выборку согласно условию (город и если $type_con != 0 тогда и с учетом типа подключения)
        return Datatables::of($abons)
                            ->addColumn('action', function($abon){
                                return "<i class='entypo-info' id=".$abon->id."></i>";
                            })
                            ->make(true);
    }

    public function datatablesFindTConIDBase(Request $request, $id, $city_id) {
        $select_query = select_all_abons(); 
        if ($city_id == 0) {
            if ($id == 0) {
                $abons = $select_query;
            } else { 
                $abons = $select_query->where('t_connection_id', $id);
            }
        } else {
            if ($id == 0) {
                $abons = $select_query->where('city_id', $city_id);
            } else {
                $abons = $select_query->where('t_connection_id', $id)->where('city_id', $city_id);
            }

        }
        // $city_id == 0 ? $abons = $select_query->where('t_connection_id', $id) : $abons = $select_query->where('t_connection_id', $id)->where('city_id', $city_id);
        return Datatables::of($abons)
                            ->addColumn('action', function($abon){
                                return "<i class='entypo-info' id=".$abon->id."></i>";
                            })
                            ->make(true);
    }

}
