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
{{-- All list cities --}}
<div class="container">
    <h3>Список всех населенных пунктов</h3>
    <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">НАЗВАНИЕ</th>
              </tr>
            </thead>
            <tbody>
        @foreach($cities as $city)
            <tr>
                <th scope="row">{{$city->id}}</th>
                <td>{{$city->name}}</td>
            </tr>
        @endforeach
</div>
@endsection