<html>
<head>
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
<link rel='stylesheet' href='/jquery.timepicker.css' />

<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.4/js/bootstrap.min.js"></script>
<script src='/jquery.timepicker.min.js'></script>
<script>

$(document).ready(function() {

	//drop down menu for time select
	$('input.timepicker').timepicker({
		timeFormat: 'h:i A',
		// year, month, day and seconds are not important
		minTime: new Date(0, 0, 0, 6, 0, 0),
		maxTime: new Date(0, 0, 0, 23, 0, 0),
		step: 15
	});

	//date picker script
	$(function() {
		$( "#datepicker" ).datepicker();
	});

});


</script>
</head>

<body>
<div id='editForm'>
	<p>
		Original Shift:<br>
		Start: <tab> {{$calendar->startShift}}<br>
		Ends: <tab> {{$calendar->endShift}}<br>
	</p>

	{!! Form::open(['method' => 'PATCH', 'action' => ['CalendarController@update', $calendar->id]]) !!}
	Change to:
	<div>
		<label>Select Day: <label>
		{!! Form::text('date','', array('id' => 'datepicker')) !!}
	</div>

	<div>
		<label>Start from: </label>
		<input class="timepicker" name="startShift" />
		<label>to: </label>
		<input class="timepicker" name="endShift" />
	</div>
	<br>
	{!! Form::submit("Save", ['class' => 'btn btn-primary form-control']) !!}
	{!! Form::close() !!}
	<br>

	{!! Form::open(['method' => 'DELETE', 'route' => ['calendar.destroy', $calendar->id]]) !!}
	   
            {!! Form::submit('Delete', ['class' => 'btn btn-danger form-control']) !!}
	  
	{!! Form::close() !!}
</div>

</body>
</html>