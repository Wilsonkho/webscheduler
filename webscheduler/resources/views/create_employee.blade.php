@extends('app')

@section('content')
	<h1>Add New Employee</h1>
	<hr/>
	@if  ($errors->any())
		<ul class='alert alert-danager'>
			@foreach ($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	@endif

	{!! Form::open(['url' => 'employees']) !!}
		<div class="form-group">
			{!! Form::label('name', 'Name:') !!}
			{!! Form::text('name',null, ['class' => 'form-control']) !!}
			{!! Form::label('email', 'Email:') !!}
			{!! Form::text('email',null, ['class' => 'form-control']) !!}
			{!! Form::label('password', 'Password:') !!}
			{!! Form::password('password', ['class' => 'form-control']) !!}
			<br>
			Select Employee Job Title:
			<br>
			{!! Form::select('position', array(
				'General Employee' => 'General Employee',
				'Team Leader' =>'Team Leader',
				'Assisstant Manager' => 'Assisstant Manager',
				'Manager' => 'Manager',
			))!!};
		</div>

		<div class="form-group">
			{!! Form::submit('Add Employee', ['class' => 'btn btn-primary form-control']) !!}
		</div>
	{!! Form::close() !!}

		<form action="/employees">
    		<input class="btn btn-primary form-control" type="submit" value="Cancel"> 
		</form>



@endsection