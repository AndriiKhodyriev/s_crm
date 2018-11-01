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
                                                <span class="tittle-alert entypo-info-circled"> СПИСОК ВСЕХ СТАТУСОВ ЗАЯВОК! ПРИ СОЗДАНИИ УЧИТЫВАТЬ (1 - Новая, 2 - В Работе, 3 - Закрта, 4 - СРОЧНО) </span>
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
                <a href="" class="btn btn-warning" data-toggle="modal" data-target="#newStatusForm">Добавить новый статус заявок </a><br>
            <hr>
        </div>
    </div>  
</div>
@include('statuses._formCreate');
{{-- All list cities --}}
<div class="container">
    <h3>Список всех статусов</h3>
    <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">НАЗВАНИЕ</th>
              </tr>
            </thead>
            <tbody>
        @foreach($statuses as $status)
            <tr>
                <th scope="row">{{$status->id}}</th>
                <td>{{$status->name}}</td>
            </tr>
        @endforeach
</div>
@else 
    <h1>НЕТ ДОСТУПА</h1>
@endif
@endsection