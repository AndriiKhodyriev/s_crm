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
                            {{Form::label('city', 'Город')}}
                            <select name="city_name" id="">
                                <option value=0> Выбрать город</option>
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
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