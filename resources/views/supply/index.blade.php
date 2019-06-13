@extends('layouts.app')

@section('content')
	<div class="row">
                        <div id="paper-top">
                                    <div class="col-sm-3">
                                        <h2 class="tittle-content-header">
                                            <i class="icon-window"></i> 
                                            <span>CRM | поставки оборудования</span>
                                        </h2>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="devider-vertical visible-lg"></div>
                                        <div class="tittle-middle-header">
                                            <div class="alert">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <span class="tittle-alert entypo-info-circled"> Для формирования заказа нажмите кнопку "Новый Заказ"</span>
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
        <div class="row">
            <div class="col-sm-2"> 
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newOrder">
                    <span class="entypo-plus-squared">   
                            Новый Заказ
                </button> 
            </div>
            <div class="col-sm-6"> 
                <div class="btn-group" position="rigth">
                    <button class="btn btn-success btn-select" id="1">Новые</button>
                    <button class="btn btn-info btn-select" id="2">В работе</button>
                    <button class="btn btn-warning btn-select" id="3">Заказано</button>
                    <button class="btn btn-danger btn-select" id="4">Отправленно</button>
                    <button class="btn btn-danger btn-select" id="5">Доставлено / Получено</button>
                </div>
            </div>
        </div>
        <hr>
    <!-- Button to Open the Modal -->   
    @if(Auth::user()->role_id == 4)
        {{-- Если пользователь МОНТАЖНИК ВЫВЕСТИ ДАННЫЕ --}}
        <table class="table table-dark">
                <thead>
                  <tr>
                    <th scope="col">№ Заказа </th>
                    <th scope="col">Товары в заказе </th>
                    <th scope="col">Кол-во</th>
                    <th scope="col">ТТН</th>
                    <th scope="col">Статус заказа </th>
                  </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                    <tr>
                        <th>{{$order->id}}</th>
                        <th>
                            @foreach($order->items as $item)
                                {{$item->item_name}}<br>
                            @endforeach
                        </th>
                        <th>
                            @foreach($order->items as $item)
                                {{$item->count}} шт. <br>
                            @endforeach
                        </th>
                        <th>{{$order->waybill}}</th>
                        <th>{{$order->status->status_name}}</th>
                    </tr>
                    @endforeach
                  <tr>

                  </tr>
                  <tr>

                  </tr>
                  <tr>

                  </tr>
                </tbody>
              </table>
    @else
        {{-- Если пользователь НЕ МОНТАЖНИК ВЫВЕСТИ ДАННЫЕ --}}
    @endif
    @include('supply._newOrder')
@endsection

@section('dt_script')
@endsection
