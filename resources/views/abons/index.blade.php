@extends('layouts.app')    

@section('content')
                    <div class="row">
                        <div id="paper-top">
                                    <div class="col-sm-3">
                                        <h2 class="tittle-content-header">
                                            <i class="icon-window"></i> 
                                            <span>CRM | База клиентов</span>
                                        </h2>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="devider-vertical visible-lg"></div>
                                        <div class="tittle-middle-header">
                                            <div class="alert">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <span class="tittle-alert entypo-info-circled"> База всех клиентов</span>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-2"> 
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newAbon">
                                <span class="entypo-plus-squared">   
                                        Добавить клиента
                            </button> 
                        </div>
                        <div class="col-sm-2"> 
                                <select name="cities" class="city-ch">
                                            <option value="0">Все города</option>
                                            @foreach($cities as $city)
                                                <option value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach     
                                    </select>
                                <span>Для выборки по объекту - выберите город</span>
                        </div>
                    </div>
                    <hr>


                    <div hidden class="table-responsive" id="main_table">
                            <table id="abon_table" class="display responsive no-wrap" width="100%" data-page-length="50">
                        {{-- <table id="repairs_table" class="table"> --}}
                                <thead>
                                    <tr>
                                        <th>Дата</th>
                                        <th>Логин</th>
                                        <th>Пароль</th>
                                        <th>ФИО</th>
                                        <th>Улица</th>
                                        <th>Дом</th>
                                        <th>Квартира</th>
                                        <th>Номер телефона</th>
                                        <th>Длинна кабеля</th>
                                        <th>Место включения</th>
                                        <th>Оплаченно</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

@include('abons._new');

<script type="text/javascript">
                $('.city-ch').change(function() {
                    var id = this.value;
                    var url = '/datatablesFindCityIDBase/'+id;
                    var table = $('#abon_table').DataTable();
                    $('#main_table').css('display','block');
                    table.destroy();
                        $(function(){
                            $('#abon_table').DataTable({
                                processing: true, 
                                serverSide: true,
                                ajax: url,
                                columns: [
                                    { data: 'city_name',                name: 'city_name'},
	                                { data: 'login',                    name: 'login' },
                                    { data: 'password',                 name: 'password' },
	                                { data: 'fullname',                 name: 'fullname' },
                                    { data: 'street',                   name: 'street' },
	                                { data: 'build',                    name: 'build' },
	                                { data: 'flat',                     name: 'flat' },
	                                { data: 'phone',                    name: 'phone'},
	                                { data: 'leng',                     name: 'leng'},
                                    { data: 'point_inc',                name: 'point_inc'},
	                                { data: 'all_money',                name: 'all_money'},
	                                // { data: 'date_action',           name: 'date_action'},
                                    // { data: 'status_name',           name: 'status_name'},
                                    // { data: 'user_name',             name: 'user_name'},
	                                // { data: 'action',                name: 'action', orderable: false, searchable: false}
                                ],
                                order: [ [0, 'desc']]
                            });
                        });
                });

</script>
@endsection                    