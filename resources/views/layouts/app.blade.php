<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    {{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script> --}}
    <script src="http://cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript" src="{{ asset('assets/js/preloader.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/app.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/load.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/main.js')}}"></script>
    @yield('dt_script')
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous"> --}}
   
    <link rel="stylesheet" href="{{asset('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/loader-style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">

</head>
<body>
    @include('inc.navbar')      
    @include('inc.sidemenu')
        <div class="wrap-fluid">
            <div class="container-fluid paper-wrap bevel tlbr">
                        <!-- CONTENT -->
                        <!--TITLE -->
                
                                        @include('inc.message')
                                        @yield('content')
                            <!-- /END OF CONTENT -->
                            <!-- FOOTER -->
                            <!-- / END OF FOOTER -->
                            </div>
                        </div>
                </div>
            </div>
            @include('inc.rightsidebar')
</body>
</html>
