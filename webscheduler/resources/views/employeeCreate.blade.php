@extends('app')

@section('content')
	<h1>Add New Employee</h1>
	<hr/>

	{!! Form::open(['url' => 'employees']) !!}
	@include('employeeFormPartials',['submitButtonText' => "Add Employee"])


	@include  ('errors/errorList')

@endsection