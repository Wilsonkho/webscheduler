@extends('app')

@section('Scripts')

<script>

	$(document).ready(function() {
	    var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		var day;

		
		//className: default(transparent), important(red), chill(pink), success(green), info(blue)

		var calendar =  $('#calendar').fullCalendar({
			theme: true,
	        header: {
	            left: 'prev,next today',
	            center: 'title',
	            right: 'month,agendaWeek,agendaDay'
	        },
			firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
			defaultView: 'month',

			
			dayClick: function(start, end, allDay, date) {
				day = date.format();
				$('#addModal #clickedDay').text("Add Shift to: " + day);
				console.log(day)
				$("#addModal").modal("show")
				$('#addModal').on('shown.bs.modal',function (event){
					var modal = $(this)
					modal.find('.modal-body #datepicker').val(day)

				})

	       	},
	       	@if ($user->position == 'Manager')
			dayClick: function(date, jsEvent, view) {
	
				$('#addModal #clickedDay').text("Add Shift to: " + date.format());
				$("#addModal").modal("show")
				$('#addModal').on('shown.bs.modal',function (event){
					var modal = $(this)
					modal.find('.modal-body #datepicker').val(moment(date).format('MM/DD/YYYY'));

				})

			},
			@endif
			@if ($user->position != 'General Employee')
			selectable: true,
			eventClick: function(calEvent) {

				$("#editModal").modal("show");

				$('#editModal').on('shown.bs.modal', function (event) {
					var modal = $(this)
					modal.find('.modal-title').text('Edit ' + calEvent.name +"'s Shift")
					$(".modal-body").load(calEvent.editLink);

				})
			},
			@endif
			displayEventTime: true,
			displayEventEnd: true,

			events: [
				@foreach ($shifts as $shift)
				    {
				    	title: ' {{$shift->name}}',
				    	start: '{{$shift->startShift}}',
				    	end: '{{$shift->endShift}}',
				    	id: '{{$shift->id}}',
				    	name: '{{$shift->name}}',
				    	editLink: 'calendar/{{$shift->id}}/edit',
				    	@if ($shift->name == $user->name)
				    		className: 'success',
				    	@else
							className: 'info',
						@endif
				    	allDay: false,
				    },
				@endforeach
			
			],
			eventTextColor: '#222222',
		
	
		});	


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
$.ajaxPrefilter(function( options, originalOptions, jqXHR ) {
    options.async = true;
});

</script>

@endsection



@section('content')

@if ($errors->any())
	<ul class="alert alert-danger">
		@foreach($errors->all() as $error)
			<li> {{$error}} </li>
		@endforeach
	</ul>
@endif
@if (isset($dayOffError))
	<ul class="alert alert-danger">
		<li>{{$dayOffError}}</li>
	</ul>
@endif
<div id='calendar-boday'>
	<div id='calendar'></div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editModalLabel">New message</h4>
      </div>
      <div class="modal-body">

        <!-- use javascript load.() to show edit page -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="addModal" role="dialog">
	<div class="modal-dialog">

	<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 class="modal-title">
				<div class="controls controls-row" id="clickedDay" style="margin-top:5px;">Add Shift to: </div>
			</h4>
			</div>

			<div class="modal-body">
			{!! Form::open(['url' => 'calendar']) !!}

					
					{!! Form::label('name', 'Select Employee:') !!}
					<select name='name' id='name'>
					@foreach($employees as $employee)
						<option>{{$employee->name}}</option>

					@endforeach
					</select>			

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
					{!! Form::submit('Save',['class' => 'btn btn-primary form-control']) !!}
					{!! Form::close() !!}
			</div>
			
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</div>
      



@endsection
