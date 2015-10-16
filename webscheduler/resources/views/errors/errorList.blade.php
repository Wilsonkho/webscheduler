	<hr>
	@if  ($errors->any())
		<ul class='alert alert-danager'>
			@foreach ($errors->all() as $error)
			<li>{{$error}}</li>
			@endforeach
		</ul>
	@endif