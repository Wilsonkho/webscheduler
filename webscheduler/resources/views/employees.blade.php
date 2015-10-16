@extends('app')

@section('content')

	<h1>List of Employees</h1>
    <hr>
     <div class="datagrid">
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Job Title</th>
                    <th>Email</th>   
                    <th>Unavaible On</th> 
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
                    <td>{{$user->unavailable}}</td>
                    <td>
                        <center>
                        <form action="employees/{{ $user->id }}/edit">
                        <input class="btn btn-primary" type="submit" value="Edit"> 
                        </form>
                        </center>
                    </td>
                    <td>
                        <center>
                        {!! Form::open(['method' => 'DELETE', 'route' => ['employees.destroy', $user->id]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            </div>
                        {!! Form::close() !!}


                        </center>


                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
	<hr/>
    <form action="employees.create">
    <input class="btn btn-primary" type="submit" value="Add Employee"> 
    </form>

	

@endsection