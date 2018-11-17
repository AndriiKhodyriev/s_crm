 <!-- Modal window create new join -->
 <div class="modal fade" id="newAbon">
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
                        {{Form::label('city', 'Населенный пункт')}}                        
                        <select name="city_name" id="">
                            @foreach($cities as $city)
                                <option value="{{$city->id}}">{{$city->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group" id="type-ch-form">
                        {{Form::label('t_connection', 'Тип подключения')}}
                        <select name="t_connections" id="">
                            @foreach($t_connections as $tcon)
                                <option value="{{$tcon->id}}">{{$tcon->name}}</option>
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
                        {{Form::label('flat', 'Квартира')}}
                        {{Form::text('flat','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '23'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('phone_num', 'Номер телефона')}}
                        {{Form::text('phone_num','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '+380501234567'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('fullname', 'Фамилия Имя Отчество')}}
                        {{Form::text('fullname','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Иванов Иван Иванович'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('comment', 'Смета')}}
                        {{Form::textarea('comment','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '100м - 600грн + подключени 600грн'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('all_money', 'Полная стоимость')}}
                        {{Form::textarea('all_money','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'ТУТ ПРОСТО ЧИСЛО СУММА'])}}
                    </div>
                    {{-- Если выбран тип подключения GPON то показывать этот див  --}}
                    <div hidden id="pon_info">
                        <div class="form-group">
                            {{Form::label('leng', 'Длинна кабеля')}}
                            {{Form::textarea('leng','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '150метров'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('point_inc', 'Точка включения')}}
                            {{Form::textarea('point_inc','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '25Т 3М'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('mac_onu', 'MAC ONU')}}
                            {{Form::textarea('mac_onu','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '1с23.2224.dbc2'])}}
                        </div>
                    </div>
                    {{-- Если выбран тип подключения Wifi то показывать этот див  --}}
                    <div hidden id="wifi_info">
                        <div class="form-group">
                            {{Form::label('leng', 'Длинна кабеля')}}
                            {{Form::textarea('leng','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '150метров'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('base_ip', 'Базовая станция')}}
                            {{Form::textarea('base_ip','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '46.164.132.206:53302'])}}
                        </div>
                        <div class="form-group">
                                {{Form::label('client_ip', 'Клиентская антена')}}
                                {{Form::textarea('client_ip','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '46.164.132.206:53310'])}}
                        </div>
                    </div>  
                    {{-- Если выбран тип подключения МЕДЬ то показывать этот див  --}}
                    <div hidden id="cable_info">
                        <div class="form-group">
                            {{Form::label('leng', 'Длинна кабеля')}}
                            {{Form::textarea('leng','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => '150метров'])}}
                        </div>
                    </div>
                    
            </div>      
            <!-- Modal footer -->
            <div class="modal-footer">
                    {{Form::submit('Добавить клиента!', ['class' => 'btn btn-success'])}}
                    {!! Form::close() !!}
            </div>
                
        </div>
    </div>
</div>

<script>
      $('.type-ch-form').change(function() {
                    var id = this.value;
                    var city_id = $(".city-ch option:selected").val();
                    var url = '/datatablesFindTConIDBase/'+id+'/'+city_id;
                    var table = $('#abon_table').DataTable();
                    $('#main_table').css('display','block');

                });
</script>