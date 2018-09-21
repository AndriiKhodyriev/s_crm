@extends('layouts.app')    

@section('content')
    <div class="container">
        <H1>Новая заявка на подключение</H1>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newJoinModal">
                Составить заявку
        </button>
    </div>
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

@endsection
@section('dt_script')
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
    
