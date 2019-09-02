@extends('layouts.app')    

@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> 
                    <div class="row">
                        <div id="paper-top">
                                    <div class="col-sm-3">
                                        <h2 class="tittle-content-header">
                                            <i class="icon-window"></i> 
                                            <span>CRM | Отчеты</span>
                                        </h2>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="devider-vertical visible-lg"></div>
                                        <div class="tittle-middle-header">
                                            <div class="alert">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <span class="tittle-alert entypo-info-circled"> Для составления отчета: 1. Выбрать город; 2. Выбрать даты; 3. Нажать кнопку </span>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
            <!--/ TITLE -->
            <!-- END OF BREADCRUMB -->
            <div class="content-wrap">
                <hr>
            @include('inc.message')
            <hr>
    <div class="row">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newBDCOM">
                <span class="entypo-plus-squared">
                    Добавить BDCOM            
            </button>
        <div class="col-sm-4">
            <div class="jumbotron">
                    <div class="form-group">
                        {{Form::label('city', 'Город')}}
                        {{-- <select name="city_name" id="city_name">
                        <option value=0>ВЫБОР ГОРОДА!</option>
                            @foreach($cities as $city) --}}
                                {{-- <option value=""> {{ $city->sum }}</option> --}}
                                {{-- <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="daterange">Выбрать или ввести диапазон в формате (YYYY-MM-DD)</label>
                        <input id="date_diap" class="form-control" type="text" name="daterange" value="" placeholder="2018-12-01 > 2018-12-31"/>
                    </div>
                {{Form::submit('Получить данные за период!', ['class' => 'btn btn-success trafic-date'])}} <br>

                <form action="/trafic_no_dates">
                    <button type="submit" class="btn btn-success trafic-no-date">Получить данные за все время</button>
                </form>
            </div>
        </div>
        <div class="col-sm-4">
            <div hidden class="jumbotron" id="sum_info">
                <div class="nest" id="">
                    <div class="title-alt">
                        <h6> Сумма</h6>
                        <div class="titleClose" id="d_stop">
                        </div>
                        <div class="titleToggle" id="d_start">
                        </div>
                    </div>
                    <div class="body-nest" id="first_content">

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div hidden class="jumbotron" id="smeta_info">
                <div class="nest" id="">
                    <div class="title-alt">
                        <h6>Смета</h6>
                        <div class="titleClose" id="dt_stop">
                        </div>
                        <div class="titleToggle" id="dt_start">
                        </div>
                    </div>
                    <div class="body-nest" id="second_content">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
//Плагин http://www.daterangepicker.com/
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
        console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
  $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
      $(this).val(picker.startDate.format('YYYY-MM-DD') + ' > ' + picker.endDate.format('YYYY-MM-DD'));
  });
});    
</script>

<script>
    $(document).on('click', '.fin-info', function(){
        $('#sum_info').css('display','block');
        $('#smeta_info').css('display','block');
        var city_id = $('#city_name option:selected').val();
        var date = $('#date_diap').val();
        $.ajax({
             headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ url('finance_key') }}",
            method:"POST",
            data: {city_id:city_id, date:date} ,
            dataType:"json",
            success:function(data)
                {
                    var arr = date.split('>');
                    $('#second_content').empty();
                    $(data.logins).each(function( index, value ) {
                        $(value).each(function(i, data_logins){
                            $('#second_content').append('Логин : ' + data_logins.login + '<br> Дата включения : ' + data_logins.created_at + '<br> Смета : ' + data_logins.comment + ' <hr>');
                        })
                    });
                    $('#d_start').empty();
                    $('#d_stop').empty();
                    $('#dt_start').empty();
                    $('#dt_stop').empty();
                    $('#first_content').empty();
                    $('#dt_start').append('C '+arr[0]);
                    $('#dt_stop').append('До '+arr[1]);
                    $('#d_start').append('C '+arr[0]);
                    $('#d_stop').append('До '+arr[1]);
                    $('#first_content').append('Всего получено : ' + data.sum + ' грн. / руб. <br> Всего было подключено : ' + data.count);
                }
        });
    });
</script>
@endsection


