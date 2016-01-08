<html>

	<body>
	{!! Form::model($employee, ['method'=>'PATCH', 'action'=>['EmployeesController@update', $employee->id]]) !!}

	@include ('employeeFormPartials', ['submitButtonText' => 'Apply Changes'])


	@include ('errors/errorList')
	</body>


</html>