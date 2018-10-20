 <!-- Modal window UPDATE user -->
 <div class="modal fade" id="newUser">
    <div class="modal-dialog">
        <div class="modal-content">      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Создание пользователя</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <!-- Modal body -->
            <div class="modal-body">
                    {!! Form::open(['action' => 'UsersController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                            {{Form::label('user_name', 'Логин: ')}}
                            {{Form::text('user_name','',['id'=> 'user_name', 'class' => 'form-control', 'placeholder' => 'Иванов Иван Ианович'])}}
                        </div>
                        <div class="container">
                            <div class="col-sm-6">
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Пароль </label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
    
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Повторный пароль </label>
    
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>
                            </div>
                        </div>
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
                                <span>Роль пользователя: </span>
                                @foreach (App\Role::all() as $role)
                                    <div class="form-check">
                                        {!! Form::radio('role', $role->id, false, ['id' => "role".$role->id]) !!}
                                        {!! Form::Label('name', $role->name) !!}
                                    </div>
                                @endforeach
                            </div>
                        </div>
            </div>      
            <!-- Modal footer -->
            <div class="modal-footer">
                    {{Form::label('info', 'После создания пользователя необходимо изменить и установить город пользователя: ')}}
                    {{Form::submit('Составить заявку!', ['class' => 'btn btn-success'])}}
                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

