{!!Form::open(['action' => ['JoinsController@destroy', $join->id], 'method' => 'POST', 'class' => 'float-right'])!!}
{{Form::hidden('_method', 'DELETE')}}
{{Form::submit('Delete',['class' => 'btn btn-danger'])}}
{!!Form::close()!!}