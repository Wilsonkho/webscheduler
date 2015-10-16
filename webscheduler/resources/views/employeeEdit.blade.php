@extends('app')

@section('content')

	<h1> Edit:  {!! $employee->name !!}</h1>

	{!! Form::model($employee, ['method'=>'PATCH', 'action'=>['EmployeesController@update', $employee->id]]) !!}

	@include ('employeeFormPartials', ['submitButtonText' => 'Apply Changes'])


	@include ('errors/errorList')


@stop

