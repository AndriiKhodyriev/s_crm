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
@if(auth()->user()->role_id == 1 OR auth()->user()->role_id == 2)

<div class="container">
    <div class="row">
        <div class="col-sm-4"> 
            <br><hr>
                <a href="{{url('/cities/create')}}" class="btn btn-warning" data-toggle="modal" data-target="#newCityForm">Добавить новый город </a><br>
            <hr>
        </div>
    </div>  
</div>

@include('cities._formCreate');
@include('cities._formEdit');
{{-- All list cities --}}
<div class="container">
    <h4>Для создания населенного пункта, необходимо создать канал телеграм для информирования о новых заявках!</h4>
    <ul class="list-group">
        <li class="list-group-item disabled">1. Создаем публичный канал Telegram</li>
        <li class="list-group-item">2. Добавляем в чат бота с логином: <b>@KronosCRMBot</b> в качестве администратора</li>
        <li class="list-group-item">3. В адресную строку вставляем ссылку: https://api.telegram.org/bot{{env('TELEGRAM_TOKEN')}}/sendMessage?chat_id=<b><u>@telegram_chat_id</u></b>&text=123</li>
        <li class="list-group-item">Значение <b><u>@telegram_chat_id</u></b> - нужно заменить на идентификатор канала</li>
        <li class="list-group-item">4. После перехода по ссылке получим массив данных, скопируйте знаение из поля ID (обычно начинается с -101) и вставьте в поле при создании города</li>
        <li class="list-group-item">5. После создания города, измените канал на "ПРИВАТНЫЙ"</li>
    </ul>
      
</div>
<div class="container">
    <h3>Список всех населенных пунктов</h3>
    <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">НАЗВАНИЕ</th>
                <th scope="col">ЧАТ ID</th>
                <th scope="col">Видимость в ремонтах/подключениях</th>
                <th scope="col">Изменить</th>
              </tr>
            </thead>
            <tbody>
        @foreach($cities as $city)
            <tr>
                <th scope="row">{{$city->id}}</th>
                <td>{{$city->name}}</td>
                <td>{{$city->chat_id}}</td>
                
                @if($city->visibility_everywhere == 1) 
                    <td>
                        <span class="label label-info"> Видимость в ремонтах / подключениях </span>
                    </td>
                @else 
                    <td>
                        <span class="label label-important"> Только для базы</span>
                    </td>
                @endif
                <td>
                    <button type="button" name="update" id={{$city->id}} class="btn btn-warning btn-xs update" >Изменить</button>
                </td>
            </tr>
        @endforeach
</div>
@else 
    <h1>НЕТ ДОСТУПА</h1>
@endif

<script type="text/javascript">
    $(document).on('click', '.update', function(){
        var id = $(this).attr("id");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:"{{ url('datatablesFindID') }}",
                method:"POST",
                data: {id:id},
                dataType:"json",
                success:function(data)
                {
                    $('#editCityForm').modal('show');
                    // $('.login').val(data.login);
                    // $('.password').val(data.password);
                    // $('.tp_name').val(data.tarif_plan);
                    // $('.fullname').val(data.fullname);
                    // $('.phone_num').val(data.phone);
                    // $('.street').val(data.street);
                    // $('.build').val(data.build);
                    // $('.flat').val(data.flat);
                    // $('.leng').val(data.leng);
                    // $('.comment').val(data.comment);
                    // $('.all_money').val(data.all_money);
                    // $('.mac_onu').val(data.mac_onu);
                    // $('.point_inc').val(data.point_inc);
                    // $('.base_ip').val(data.base_ip);
                    // $('.client_ip').val(data.client_ip);
                    // $('#action_module').attr('action','/abons/'+data.id);
                }
        });
    });
</script>
@endsection