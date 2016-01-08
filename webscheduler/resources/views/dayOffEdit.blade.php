<html>

	<body>

	{!! Form::open(['method' => 'PATCH', 'action' => ['dayOffController@update', $dayOff->id]]) !!}
	

	{!! Form::submit("Approve", ['class' => 'btn btn-primary form-control']) !!}


	{!! Form::close() !!}

<br>

	{!! Form::open(['method' => 'DELETE', 'route' => ['dayOff.destroy', $dayOff->id]]) !!}
	   
    {!! Form::submit('Decline', ['class' => 'btn btn-danger form-control']) !!}
	  
	{!! Form::close() !!}
	</body>


</html>