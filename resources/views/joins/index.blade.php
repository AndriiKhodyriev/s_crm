@extends('layouts.app')    

@section('content')
    <div class="container">
        <H1>Заявки на подключение</H1>
    </div>
    <div class="container">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newJoinModal">
                Составить заявку
        </button>

        <hr>
    </div>    
    <!-- The table frame for displaying all orders using data modules --> 
            <table id="joins_table" class="table table-bordered">
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
                        {{Form::submit('Составить заявку!', ['class' => 'btn btn-primary'])}}
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
                        
                            {!! Form::open(['action' => ['JoinsController@update', data.id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
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
                            {{Form::submit('Составить заявку!', ['class' => 'btn btn-primary'])}}
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
    
