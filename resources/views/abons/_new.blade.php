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
                            {{Form::label('city', 'Город')}}
                            <select name="city_name" id="">
                                @foreach($cities as $city)
                                    <option value="{{$city->id}}">{{$city->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            {{Form::label('t_connection', 'Тип подключения')}}
                            <select name="t_connections" id="type-ch">
                                    <option value=0>ВЫБОР</option>
                                @foreach($t_connections as $t_con)
                                    <option value="{{$t_con->id}}">{{$t_con->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- ОСНОВНЫЕ ЕЛЕМЕНТЫ ДЛЯ ВСЕХ ТИПО ПОДКЛЮЧЕНИЯ 
                            - логин 
                            - пароль 
                            - фио
                            - номер телефона
                            - улица
                            - дома 
                            - квартира
                            - сколько денег 
                            - смета по подключению
                                --}}
                        <div class="form-group">
                            {{Form::label('login', 'Логин')}}
                            {{Form::text('login','',['class' => 'form-control', 'placeholder' => '430666 / udar231 / uk123'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('password', 'Пароль')}}
                            {{Form::text('password','',['class' => 'form-control', 'placeholder' => '451447'])}}
                        </div>  
                        <div class="form-group">
                            {{Form::label('fullname', 'ФИО')}}
                            {{Form::text('fullname','',['class' => 'form-control', 'placeholder' => 'Вассерман Инокентий Вассерманович'])}}
                        </div>  
                        <div class="form-group">
                            {{Form::label('phone_num', 'Номер телефона')}}
                            {{Form::text('phone_num','',['class' => 'form-control', 'placeholder' => '380501234567'])}}
                        </div>
                        <div class="form-group">
                            {{Form::label('street', 'Улица')}}
                            {{Form::text('street','',['class' => 'form-control', 'placeholder' => 'Ульяновская ул.'])}}
                        </div>           
                        <div class="form-group">
                            {{Form::label('build_flat', 'Дом - Квартира')}}
                                {{Form::text('build','',['class' => 'form-control', 'placeholder' => '39Д'])}}
                                {{Form::text('flat','',['class' => 'form-control', 'placeholder' => '2'])}}
                        </div>              
                        <div class="form-group">
                                {{Form::label('all_money', 'Сумма')}}
                                {{Form::text('all_money','',['class' => 'form-control', 'placeholder' => '1500 (ПИСАТЬ ТОЛЬКО ЧИСЛО)'])}}
                        </div> 
                        <div class="form-group">
                                {{Form::label('comment', 'Смета')}}
                                {{Form::text('comment','',['class' => 'form-control', 'placeholder' => 'Кабель 100м - 600грн + Подключнеие - 600грн'])}}
                        </div> 
                        {{-- КОНЕЦ ОСНОВНЫЕ ЕЛЕМЕНТЫ ДЛЯ ВСЕХ ТИПО ПОДКЛЮЧЕНИЯ --}}
                        {{-- ЭЛЕМЕНТЫ ДЛЯ ПОДКЛЮЧЕНИЯ ПО PON 
                            - mac_onu (мак ону)
                            - point_inc (точка включения)
                            --}}
                        <div id="pon_view" hidden>
                            <div class="form-group">
                                {{Form::label('mac_onu', 'MAC Ону')}}
                                {{Form::text('mac_onu','',['class' => 'form-control', 'placeholder' => '1c87:7912:14dc'])}}
                            </div> 
                            <div class="form-group">
                                {{Form::label('point_inc', 'Место включения')}}
                                {{Form::text('point_inc','',['class' => 'form-control', 'placeholder' => '24Т 4М'])}}
                            </div> 
                        </div> 
                        {{-- КОНЕЦ ПОНА --}}
                        {{-- ЭЛЕМЕНТЫ ДЛЯ ПОДКЛЮЧЕНИЯ ПО WiFi
                            - base_ip
                            - clien_ip
                            --}}
                        <div id="wifi_view" hidden>
                            <div class="form-group">
                                {{Form::label('base_ip', 'Базовая станция')}}
                                {{Form::text('base_ip','',['class' => 'form-control', 'placeholder' => 'http://46.164.132.206:52302'])}}
                            </div> 
                            <div class="form-group">
                                {{Form::label('clien_ip', 'Антена клиента')}}
                                {{Form::text('clien_ip','',['class' => 'form-control', 'placeholder' => 'http://46.164.132.206:52309'])}}
                            </div> 
                        </div>     
                        {{-- КОНЕЦ WiFi --}}
                        <div class="form-group">
                            {{Form::label('leng', 'Кабель')}}
                            {{Form::text('comment','',['class' => 'form-control', 'placeholder' => '100 (ПИСАТЬ ТОЛЬКО ЧИСЛО)'])}}
                        </div> 
                </div>      
                <!-- Modal footer -->
                <div class="modal-footer">
                        {{Form::submit('Создать клиента!', ['class' => 'btn btn-success'])}}
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
<script>
    $('#type-ch').change(function() {
        $('#pon_view').css('display','none');
        $('#wifi_view').css('display','none');
                    var id = this.value;
                    if (id == 1) {
                        $('#pon_view').css('display','block');
                    } else if (id == 2) {
                        $('#wifi_view').css('display','block');
                    }
                });
</script>