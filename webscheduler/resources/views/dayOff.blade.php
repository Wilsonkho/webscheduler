@extends('app')

@section('Scripts')
<script type="text/javascript">

	//drop down menu for time select
	$('input.timepicker').timepicker({
	    timeFormat: 'H:i',
	    // year, month, day and seconds are not important
	    minTime: new Date(0, 0, 0, 6, 0, 0),
	    maxTime: new Date(0, 0, 0, 23, 0, 0),
	    step: 15
	});

    //date picker script
    $(function() {
		$( "#datepicker" ).datepicker();
		});
</script>


@endsection

@section('content')
	

	<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal">Request Time Off</button>

<br>
<br>
<!-- Modal -->
<div id="addModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Request Time Off</h4>
      </div>
      <div class="modal-body">
        

		{!! Form::open(['url' => 'dayOff']) !!}
		<div>
			<label>Select Day: <label>
			{!! Form::text('date','', array('id' => 'datepicker')) !!}
		</div>
		{!! Form::submit('Submit Request', ['class' => 'btn btn-primary form-control']) !!}
		{!! Form::close() !!}

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	<div class="datagrid">

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Status</th>
                @if ($user->position == 'Manager')   
                <th>Edit</th> 
                @endif
            </tr>
        </thead>

		<tbody>

		    @foreach ($timeOffs as $timeOff)
		    <tr>
		        <td>{{$timeOff->name}}</td>
		        <td>{{$timeOff->date}}</td>
		        <td>{{$timeOff->status}}</td>
            @if ($user->position == 'Manager')   
		        <td><center>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-link="dayOff/{{ $timeOff->id }}/edit">Edit</button>
				    </center></td>
            @endif
		    </tr>
		    @endforeach
		</tbody>

    </table>
	</div>


<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="editModalLabel">Approve/Decline</h4>
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

<script>
$('#editModal').on('shown.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var link = button.data('link') // Extract info from data-* attributes
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  // modal.find('.modal-body input').val(recipient)
  $(".modal-body").load(link);
})
</script>

@endsection
