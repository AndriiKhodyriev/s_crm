@extends('layouts.app')    

@section('content')
                    <div class="row">
                        <div id="paper-top">
                                    <div class="col-sm-3">
                                        <h2 class="tittle-content-header">
                                            <i class="icon-window"></i> 
                                            <span>CRM</span>
                                        </h2>
                                    </div>
                                    <div class="col-sm-9">
                                        <div class="devider-vertical visible-lg"></div>
                                        <div class="tittle-middle-header">
                                            <div class="alert">
                                                <button type="button" class="close" data-dismiss="alert">×</button>
                                                <span class="tittle-alert entypo-info-circled"> SNMP</span>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>

                    @if(auth()->user()->role_id !== 4)
                    <div class="container">


                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                            {{-- {{ Form::open(array('url' => 'snmp/getONUInfo')) }} --}}
                            {{ Form::open(array('id' => 'getONUInfo')) }}
                                {{ csrf_field() }}
                            <div class="form-group">
                                {{Form::label('oltIP', 'IP-адрес головы')}}
                                {{Form::text('oltIP','',['class' => 'form-control', 'placeholder' => '10.251.0.1'])}}
                            </div>
                            <div class="form-group">
                                    {{Form::label('onuMAC', 'MAC-адрес ONU')}}
                                    {{Form::text('onuMAC','',['id'=> 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'a0c6ec040dc4'])}}
                            </div>
                            {{Form::submit('УЗНАТЬ ВСЕ', ['class' => 'btn btn-success'])}}
                            
                            {{ Form::close() }}

                    </div>
                   
                        <div id='snmpResult'></div>
                    
                    
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('#getONUInfo').on('submit', function(e){
                                e.preventDefault();
                                $('#snmpResult').empty();
                                $.ajax({
                                    type: 'POST',
                                    url: '/snmp/getONUInfo',
                                    data: $('#getONUInfo').serialize(),
                                    success: function(response){            
                                                if ( response['errorMsg'] != "none") {
                                                    var error = $("<div class='alert alert-danger'></div>").html(response['errorMsg']);
                                                    $("#snmpResult").append(error);
                                                } else {
                                                    var success = $("<div class='alert alert-success'></div>").html(response['successMsg']);
                                                    $("#snmpResult").append(success);
                                                }      
                                    }
                                });
                            });
                        });
                    </script>
@else 
        <h1>НЕТ ДОСТУПА</h1>
@endif
@endsection                    