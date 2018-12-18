<div class="modal fade" id="editCityForm">
        <div class="modal-dialog">
            <div class="modal-content">      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Изменить объект</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                        {!! Form::open(['action' => 'CitiesController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group">
                            {{Form::label('city', 'Полное название населенного пункта')}}
                            {{Form::text('city','',['class' => 'form-control', 'placeholder' => 'Полное название!'])}}
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-sm-2">
                                    {{Form::checkbox('check', '0', false, ['class' => 'form-control'])}}
                                </div>
                                <div class="col-sm-6">
                                    {{Form::label('check', 'Видимость в ремонтах / подключениях')}}
                                </div>
                                
                            </div>                         
                        </div>
                        <div class="form-group">
                            {{Form::label('chat_id', 'ID чата телеграмма!')}}
                            {{Form::text('chat_id','',['class' => 'form-control', 'placeholder' => '-1001179946668'])}}
                        </div>

                </div>      
                <!-- Modal footer -->
                <div class="modal-footer">
                        {{Form::submit('Создать запись!', ['class' => 'btn btn-success'])}}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>