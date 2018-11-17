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
                            <a href="{{ route('abons.create') }}">КНОПОЧКА</a>
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
                        <div class="col-sm-2" hidden id='type_con'> 
                            <select name="t_connections" class="type-ch">
                                        <option value="0">Все типы подключения</option>
                                        @foreach($t_connections as $t_con)
                                            <option value="{{$t_con->id}}">{{$t_con->name}}</option>
                                        @endforeach     
                                </select>
                            <span>Для выборки по типу подключения - выберите тип </span>
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
                                        <th>Номер телефона</th>
                                        <th>Длина кабеля</th>
                                        <th>Место включения</th>
                                        <th>Оплачено</th>
                                        <th>Смета</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>

{{-- @include('abons._new');
@include('abons._newPon');
@include('abons._newWifi');
@include('abons._newCable'); --}}

<script type="text/javascript">
                
                $('.city-ch').change(function() {
                    var id = this.value;
                    $('#type_con').css('display','block');
                    var type_con = $(".type-ch option:selected").val();
                    var url = '/datatablesFindCityIDBase/'+id+'/'+type_con;
                    var table = $('#abon_table').DataTable();
                    $('#main_table').css('display','block');
                    table.destroy();
                    dt_render(url);
                });

                $('.type-ch').change(function() {
                    var id = this.value;
                    var city_id = $(".city-ch option:selected").val();
                    var url = '/datatablesFindTConIDBase/'+id+'/'+city_id;
                    var table = $('#abon_table').DataTable();
                    $('#main_table').css('display','block');
                    table.destroy();
                    dt_render(url);
                });
    
            function dt_render(url) {
                $('#abon_table').DataTable({
                                processing: true, 
                                serverSide: true,
                                ajax: url,
                                columns: [
                                    { data: 'created_at',               name: 'created_at'},
	                                { data: 'login',                    name: 'login' },
                                    { data: 'password',                 name: 'password' },
	                                { data: 'fullname',                 name: 'fullname' },
                                    { data: 'street',                   name: 'street' },
	                                { data: 'build',                    name: 'build' },
	                                { data: 'phone',                    name: 'phone'},
	                                { data: 'leng',                     name: 'leng'},
                                    { data: 'point_inc',                name: 'point_inc'},
	                                { data: 'all_money',                name: 'all_money'},
                                    { data: 'comment',                  name: 'comment'}
	                                // { data: 'date_action',           name: 'date_action'},
                                    // { data: 'status_name',           name: 'status_name'},
                                    // { data: 'user_name',             name: 'user_name'},
	                                // { data: 'action',                name: 'action', orderable: false, searchable: false}
                                ],
                                order: [ [0, 'desc']]
                            });
            }
            
            $(document).on('click', '.label', function(){
                var id = $(this).attr("id");
                $('#newAbon').modal('show');
                    
            });
</script>
@endsection                    