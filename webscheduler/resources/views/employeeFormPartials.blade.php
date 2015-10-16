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
			{!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
		</div>

	{!! Form::close() !!}
		<form action="/employees">
    		<input class="btn btn-primary form-control" type="submit" value="Cancel"> 
		</form>