@extends('layouts.app')    

@section('content')
                    <div class="row">
                        <div id="paper-top">
                                    <div class="col-sm-3">
                                        <h2 class="tittle-content-header">
                                            <i class="icon-window"></i> 
                                            <span>CRM</span>
                                        </h2>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="devider-vertical visible-lg"></div>
                                        <div class="tittle-middle-header">
                                            <div class="alert">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <span class="tittle-alert entypo-info-circled"> Список всех городов! Для изменения и удаления вы должны быть администратором или менеджером </span>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
{{-- buttons CREATE and OTHER! --}}
{{-- <div class="container">
    <div class="row">
        <div class="col-sm-4"> 
            <br><hr>
                <a href="{{url('/cities/create')}}" class="btn btn-warning" data-toggle="modal" data-target="#newCityForm">Добавить новый город </a><br>
            <hr>
        </div>
    </div>  
</div> --}}

{{-- All list cities --}}
@if(auth()->user()->role_id == 1 OR auth()->user()->role_id == 2)
<div class="container">
    <h3>Список всех пользователей</h3>
    <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Логин</th>
                <th scope="col">Полное имя</th>
                <th scope="col">Номер телефона</th>
                <th scope="col">Роль</th>
                <th scope="col">Редактирование</th>
              </tr>
            </thead>
            <tbody>
                @foreach($users as $user) 
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->username}}</td>
                    <td>{{$user->fullname}}</td>
                    <td>{{$user->phone_num}}</td>
                    <td>{{$user->role->name}}</td>
                    <td><button type="button" name="update" id='{{$user->id}}' class="btn btn-warning btn-xs update" >Изменить</button></td>
                </tr>
                @endforeach
            </tbody>
</div>

@include('users._formEdit');
        <script>
            $(document).on('click', '.update', function(){
                var id = $(this).attr("id");
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:"{{ url('findUserId') }}",
                        method:"POST",
                        data: {id:id} ,
                        dataType:"json",
                        success:function(data)
                        {
                            $('.checkBoxFild').prop('checked', false);
                            for(index = 0; index<data['count_cities']; index++) {
                                $('#'+data[index]).prop('checked', true);
                            }
                            $('#role'+data['user'].role_id).prop('checked', true);
                            $('#updateUser').modal('show');
                            $('#full_name').val(data['user'].fullname);
                            $('#phone_num').val(data['user'].phone_num);
                            $('#action_module').attr('action','/users/'+data['user'].id);
                        }
                })
            });
        </script>
@else 
        <h1>НЕТ ДОСТУПА</h1>
@endif
@endsection