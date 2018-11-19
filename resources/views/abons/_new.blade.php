 <!-- Modal window create new join -->
{{-- <link rel="stylesheet" type="text/css" href="http://yui.yahooapis.com/3.3.0/build/cssreset/reset-min.css"> --}}
{{-- <link href='http://fonts.googleapis.com/css?family=Lato:400,700' rel='stylesheet' type='text/css'> --}}
<link rel="stylesheet" href="{{asset('assets/css/tabulous.css')}}">
 <div class="modal fade" id="newAbon">
    <div class="modal-dialog">
        <div class="modal-content">      
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Новый клиент</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body">			
                            <div id="tabs4">
                                <ul>
                                    <li><a href="#tabs-1" title="">GPON</a></li>
                                    <li><a href="#tabs-2" title="">WiFi</a></li>
                                    <li><a href="#tabs-3" title="">Медь</a></li>
                                </ul>
                        
                                <div id="tabs_container">
                                    
                        
                        
                        
                                <div id="tabs-1">
                                        <p>Proin elit arcu, rutrum commodo, vehicula tempus, commodo a, risus. Curabitur nec arcu. Donec sollicitudin mi sit amet mauris. Nam elementum quam ullamcorper ante. Etiam aliquet massa et lorem. Mauris dapibus lacus auctor risus.</p><p>Aenean tempor ullamcorper leo. Vivamus sed magna quis ligula eleifend adipiscing. Duis orci. Aliquam sodales tortor vitae ipsum. Aliquam nulla. Duis aliquam molestie erat. Ut et mauris vel pede varius sollicitudin. Sed ut dolor nec orci tincidunt interdum. Phasellus ipsum. Nunc tristique tempus lectus.</p>
                                </div>
                        
                                <div id="tabs-2">
                                        <p>Morbi tincidunt, dui sit amet facilisis feugiat, odio metus gravida ante, ut pharetra massa metus id nunc. Duis scelerisque molestie turpis. Sed fringilla, massa eget luctus malesuada, metus eros molestie lectus, ut tempus eros massa ut dolor.</p>
                            
                                </div>
                        
                                <div id="tabs-3">
                                        <p>Mauris eleifend est et turpis. Duis id erat. Suspendisse potenti. Aliquam vulputate, pede vel vehicula accumsan, mi neque rutrum erat, eu congue orci lorem eget lorem.</p><p> Vestibulum non ante. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Fusce sodales.</p>
                                </div>
                        
                                </div><!--End tabs container-->
                                
                            </div><!--End tabs-->
                        
                                
                    {{-- {!! Form::open(['action' => 'JoinsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
                    <div class="form-group">
                        
                        <select name="city_name" id="">
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
            </div>       --}}
            <!-- Modal footer -->
        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('assets/js/tabulous.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/js.js')}}"></script>
