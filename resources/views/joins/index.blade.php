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
                                                <span class="tittle-alert entypo-info-circled"> Для составления заявки нажмите на кнопку "Составить заявку"</span>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
            <!--/ TITLE -->
            <!-- END OF BREADCRUMB -->
            <div class="content-wrap">
                <hr>
            <div class="row">
                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newJoinModal">
                            Составить заявку
                    </button> | 
                <div class="btn-group" position="rigth">
                    <button class="btn btn-warning">Кнопка 1</button>
                    <button class="btn btn-danger">Кнопка 2</button>
                    <button class="btn btn-info">Кнопка 3</button>

                </div>
            </div>
        <hr>
    <!-- The table frame for displaying all orders using data modules --> 
    <style>

        
    </style>
            <table id="joins_table" class="table ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Улица</th>
                        <th>Дом</th>
                        <th>ФИО</th>
                        <th>Телефон</th>
                        <th>Дата составления заявки</th>
                        <th>Статус заявки</th>
                        <th>Комментарий</th>
                        <th>action</th>
                    </tr>
            </table>
    <!-- Modal window create new join -->
    <div class="modal fade" id="newJoinModal">
        <div class="modal-dialog">
            <div class="modal-content">      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Новая заявка</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <style>
                </style>
                <!-- Modal body -->
                <div class="modal-body">
                        {!! Form::open(['action' => 'JoinsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{Form::label('street', 'Улица')}}
                            {{Form::text('street','',['class' => 'form-control', 'placeholder' => 'Ульяновская ул.'])}}
                        </div>
                        <div class="form-group">
                                {{Form::label('build', 'Дом')}}
                                {{Form::text('build','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '23Д'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('full_name', 'ФИО')}}
                            {{Form::text('full_name','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Иванов Иван Иванович'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('phone_num', 'Номер телефона')}}
                            {{Form::text('phone_num','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '+380501234567'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('comment', 'Комментарий')}}
                            {{Form::textarea('comment','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Тут можно указать любой комментарий по текущей заявке'])}}
                        </div>
                </div>      
                <!-- Modal footer -->
                <div class="modal-footer">
                        {{Form::submit('Составить заявку!', ['class' => 'btn btn-success'])}}
                        {!! Form::close() !!}
                </div>
                    
            </div>
        </div>
    </div>
    <!-- Modal window UPDATE join -->
    <div class="modal fade" id="updateJoin">
            <div class="modal-dialog">
                <div class="modal-content">      
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Редактирование заявки</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">  
                        {!! Form::open(['id' => 'action_module', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} 
                            <div class="form-group">
                                {{Form::label('street', 'Улица')}}
                                {{Form::text('street','',['id'=> 'str', 'class' => 'form-control', 'placeholder' => 'Ульяновская ул.'])}}
                            </div>
                       
                            <div class="form-group">
                                {{Form::label('build', 'Дом')}}
                                {{Form::text('build','',['id'=> 'build', 'class' => 'form-control', 'placeholder' => '23Д'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('full_name', 'ФИО')}}
                                {{Form::text('full_name','',['id'=> 'full_name', 'class' => 'form-control', 'placeholder' => 'Иванов Иван Иванович'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('phone_num', 'Номер телефона')}}
                                {{Form::text('phone_num','',['id'=> 'phone_num', 'class' => 'form-control', 'placeholder' => '+380501234567'])}}
                            </div>
                            <div class="form-group">
                                {{Form::label('comment', 'Комментарий')}}
                                {{Form::textarea('comment','',['id'=> 'comment', 'class' => 'form-control', 'placeholder' => 'Тут можно указать любой комментарий по текущей заявке'])}}
                            </div>
                    </div>      
                    <!-- Modal footer -->
                    <div class="modal-footer">
                            {{Form::hidden('_method', 'PUT')}}
                            {{Form::submit('Редактировать заявку!', ['class' => 'btn btn-warning' ])}}
                            {!! Form::close() !!}
                    </div>
                        
                </div>
            </div>
        </div>
        <!-- Update button -->
        <script>
            $(document).on('click', '.update', function(){
                var id = $(this).attr("id");
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url:"{{ url('datablesFindById') }}",
                        method:"POST",
                        data: {id:id} ,
                        dataType:"json",
                        success:function(data)
                        {
                            $('#updateJoin').modal('show');
                            $('#str').val(data.street);
                            $('#build').val(data.build);
                            $('#full_name').val(data.full_name);
                            $('#phone_num').val(data.phone_num);
                            $('#comment').val(data.comment);
                            $('#action').val(data.id);
                            $('#action_module').attr('action','/joins/'+data.id);
                        }
                })
            });
        </script>
   
@endsection
@section('dt_script')
        <!-- DataTables loader -->
            <script type="text/javascript">
                $(function() {
                    $('#joins_table').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ url('datablesAllJoins') }}',
                    columns: [
                                { data: 'id',               name: 'id' },
                                { data: 'street',           name: 'street' },
                                { data: 'build',            name: 'build' },
                                { data: 'full_name',        name: 'full_name'},
                                { data: 'phone_num',        name: 'phone_num'},
                                { data: 'created_at',       name: 'created_at'},
                                { data: 'ticket_status_id', name: 'ticket_status_id'},
                                { data: 'comment',          name: 'comment'},
                                { data: 'action',           name: 'action', orderable: false, searchable: false}
                            ]
                    });
                });
            </script>
        
@endsection
    
