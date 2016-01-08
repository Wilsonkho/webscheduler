@extends('app')

@section('content')
    <hr>
     <div class="datagrid">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Email</th>   
                    <th>Edit Profile</th>  
                    <th>Delete Employee</th>      
                </tr>
            </thead>

            <tbody>

                @foreach ($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->position}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <center>
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal" data-name ="{{ $user->name }}" data-link="employees/{{ $user->id }}/edit">Edit</button>
                        </center>
                    </td>
                    <td>
                      <center>
                      {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy', $user->id]]) !!}
                      {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                      {!! Form::close() !!}
                      </center>
                 
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
	<hr/>


<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#addModal">Add Employee</button>


<!-- Modal -->
<div id="addModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add New Employee</h4>
      </div>
      <div class="modal-body">
        
        {!! Form::open(['url' => 'employees']) !!}
        @include('employeeFormPartials',['submitButtonText' => "Add Employee"])
        @include  ('errors/errorList')

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
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
<script>
$('#editModal').on('shown.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  var link = button.data('link') // Extract info from data-* attributes
  var name = button.data('name')
  // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
  // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
  var modal = $(this)
  modal.find('.modal-title').text('Edit ' + name)
  // modal.find('.modal-body input').val(recipient)
  $(".modal-body").load(link);
})
</script>
@endsection