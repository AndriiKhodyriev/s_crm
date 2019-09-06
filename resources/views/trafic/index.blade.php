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
                                            <span>CRM | Трафик</span>
                                        </h2>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="devider-vertical visible-lg"></div>
                                        <div class="tittle-middle-header">
                                            <div class="alert">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <span class="tittle-alert entypo-info-circled"> Для составления отчета: 1. IP Устройства; 2. Выбрать даты; 3. Нажать кнопку </span>
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
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#BDCOMInfo">
                <span class="entypo-plus-squared">
                    Инормация по BDCOM            
            </button>
        <div class="col-sm-4">
            <div class="jumbotron">
                    <div class="form-group">
                        {{Form::label('head', 'Голова')}}
                        <select name="head_id" id="head_inform">
                        <option value=0>Выбрать адрес BDCOM!</option>
                            @foreach($bdcoms as $bdcom)
                                {{-- <option value=""> {{ $city->sum }}</option> --}}
                                <option value="{{$bdcom->id}}">{{$bdcom->dbcomip}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="daterange">Выбрать или ввести диапазон в формате (YYYY-MM-DD)</label>
                        <input id="date_diap"  class="form-control" type="text" name="daterange" value="" placeholder="2018-12-01 > 2018-12-31"/>
                    </div>
                 {{Form::submit('Получить данные за период!', ['class' => 'btn btn-success trafic-date'])}} 
                <br>

                {{-- <form action="/trafic_no_dates">
                    <button type="submit" class="btn btn-success trafic-no-date">Получить данные за все время</button>
                </form> --}}
            </div>
        </div>
        <div class="col-sm-4">
            <div hidden class="jumbotron" id="input_form">
                <div class="nest" id="">
                    <div class="title-alt">
                        <h6>Скачал</h6>
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
            <div hidden class="jumbotron" id="output_form">
                <div class="nest" id="">
                    <div class="title-alt">
                        <h6>Отдал</h6>
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
@include('trafic._newBDCOM')
@include('trafic._dbcominfo')
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
    $(document).on('click', '.trafic-date', function(){
        $('#input_form').css('display','block');
        $('#output_form').css('display','block');
        var head_id = $('#head_inform option:selected').val();
        var date = $('#date_diap').val();
        $.ajax({
             headers: {
                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             url:"{{ url('selecthead') }}",
             method:"POST",
             data: {head_id:head_id, date:date} ,
             dataType:"json",
             success:function(data)
                {   
                    $('#first_content').empty();
                    $('#second_content').empty();
                    $(data.trafic_input).each(function(index, value) {
                       $(value).each(function(i, data_tf){
                            $('#first_content').append('Interface : <b>' + data_tf.interface + '</b><br> MAC address : <b>' + data_tf.mac + '</b><br> Скачанно : ' + data_tf.inputTrafic + ' <b>GB</b> <hr>');
                       })
                    });
                    $(data.trafic_output).each(function(index, value) {
                       $(value).each(function(i, data_tf){
                            $('#second_content').append('Interface : <b>' + data_tf.interface + '</b><br> MAC address : <b>' + data_tf.mac + '</b><br> Отдано : ' + data_tf.outputTrafic + ' <b>GB</b> <hr>');
                       })
                    });
                }
        });
    });
</script>
@endsection


