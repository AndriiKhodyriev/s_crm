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
                            {{Form::label('city_name', 'Город заявки')}}
                            <select name="city_name" id="city_name">
                                    <option value="0">Выберете город для изменения!</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                                <span>Для изменения города, выберите из списка</span>
                            </select>
                        </div>
                        <div class="form-group">
                            {{Form::label('status', 'Сатус заявки')}}
                            <select name="status_name" id="status_name">
                                    <option value="0">Выберите статус для изменения!</option>
                                @foreach($statuses as $status)
                                    <option value="{{$status->id}}">{{$status->name}}</option>
                                @endforeach
                                <span>Для изменения статуса, выберите из списка.</span>
                            </select>
                        </div>
                        <div class="form-group">
                                {{Form::label('join_area', 'Место включения!')}}
                                {{Form::text('join_area','',['id'=> 'join_area', 'class' => 'form-control'])}}
                            </div>
                        <div class="form-group">
                            {{Form::label('street', 'Улица')}}
                            {{Form::text('street','',['id'=> 'str', 'class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('build', 'Дом')}}
                            {{Form::text('build','',['id'=> 'build', 'class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('full_name', 'ФИО')}}
                            {{Form::text('full_name','',['id'=> 'full_name', 'class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('phone_num', 'Номер телефона')}}
                            {{Form::text('phone_num','',['id'=> 'phone_num', 'class' => 'form-control'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('comment', 'Комментарий')}}
                            {{Form::textarea('comment','',['id'=> 'comment', 'class' => 'form-control'])}}
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