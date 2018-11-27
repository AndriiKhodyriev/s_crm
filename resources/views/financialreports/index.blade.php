@extends('layouts.app')    

@section('content')
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
        <div class="col-sm-4">
            <div class="jumbotron">
                    <div class="form-group">
                        {{Form::label('city', 'Город')}}
                        <select name="city_name" id="city_name">
                        <option value=0>ВЫБОР ГОРОДА!</option>
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="daterange">Выбрать или ввести диапазон в формате (ММ/ДД/ГГГГ)</label>
                        <input id="date_diap" class="form-control" type="text" name="daterange" value="01/01/2018 - 01/15/2018" />
                    </div>
                {{Form::submit('Получить сумму и смету за выбранный период!', ['class' => 'btn btn-success fin-info'])}}
            </div>
        </div>
        <div class="col-sm-4">
            <div hidden class="jumbotron" id="sum_info">
                ТЕСТ ИНФОРМАЦИЯ
            </div>
        </div>
        <div class="col-sm-4">
            <div hidden class="jumbotron" id="smeta_info">
                ТЕСТ ИНФОРМАЦИЯ
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
});    
</script>

<script>
    $(document).on('click', '.fin-info', function(){
        $('#sum_info').css('display','block');
        $('#smeta_info').css('display','block');
        var city_id = $('#city_name option:selected').val();
        var date = $('#date_diap').val();
        alert (date);
    });
</script>
@endsection


