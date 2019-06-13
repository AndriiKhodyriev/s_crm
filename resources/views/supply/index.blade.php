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
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createRepair">
                    <span class="entypo-plus-squared">   
                            Новый Заказ
                </button> 
            </div>
            <div class="col-sm-2"> 
                <div class="btn-group" position="rigth">
                    <button class="btn btn-success btn-select" id="0">Все</button>
                    <button class="btn btn-info btn-select" id="1">Новые заявки</button>
                    <button class="btn btn-warning btn-select" id="2">В работе</button>
                    <button class="btn btn-danger btn-select" id="3">Закрытые</button>
                </div>
            </div>
        </div>
        <hr>
	<!-- Button to Open the Modal -->   
@endsection

@section('dt_script')
@endsection
