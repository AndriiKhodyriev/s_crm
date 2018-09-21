@extends('layouts.app')

@section('content')
	<h1>Repairs<h1>
	<br>
	<div class="list-group">
	@foreach($repairs as $repair)
	
	  <a href="#" class="list-group-item list-group-item-action">
	    {{$repair}}
	  </a>
	  
	@endforeach
	</div>	

@endsection