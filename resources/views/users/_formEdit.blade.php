 <!-- Modal window UPDATE user -->
 <div class="modal fade" id="updateUser">
        <div class="modal-dialog">
            <div class="modal-content">      
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Редактирование пользователя</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">  
                    {!! Form::open(['id' => 'action_module', 'class' => 'form-horizontal', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!} 
                        {{-- <div class="form-group">
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
                        </div> --}}
                        <div class="form-group">
                            {{Form::label('full_name', 'Ф.И.О.!')}}
                            {{Form::text('full_name','',['id'=> 'full_name', 'class' => 'form-control', 'placeholder' => 'Иванов Иван Ианович'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('phone_num', 'Номер телефона')}}
                            {{Form::text('phone_num','',['id'=> 'phone_num', 'class' => 'form-control', 'placeholder' => '+380991234567'])}}
                        </div>
                        <div class="container">
                            <div class="col-sm-3">
                                <span>Объекты пользователя: </span>
                                @foreach (App\City::all() as $city)
                                    <div class="form-check">
                                        {!! Form::checkbox('city[]', $city->id, false, ['id' => $city->id,'class' => 'iCheck-helper checkBoxFild']) !!}
                                        {!! Form::Label('name', $city->name, ['id' => $city->id, 'class' => '']) !!}
                                    </div>
                                @endforeach
                            </div>
                            <div class="col-sm-3">
                                <span>Роль пользователя: </span>
                                @foreach (App\Role::all() as $role)
                                    <div class="form-check">
                                        {!! Form::radio('role', $role->id, false, ['id' => "role".$role->id]) !!}
                                        {!! Form::Label('name', $role->name) !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <hr>
                        
                </div>      
                <!-- Modal footer -->
                <div class="modal-footer">
                        {{Form::hidden('_method', 'PUT')}}
                        {{Form::submit('Редактировать пользователя!', ['class' => 'btn btn-warning' ])}}
                        {!! Form::close() !!}
                </div> 
            </div>
        </div>
    </div>

