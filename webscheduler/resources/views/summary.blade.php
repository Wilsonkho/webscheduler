@extends('app')

@section('Scripts')

<script type="text/javascript">

//date picker script
$(function() {
    $( "#datepicker1" ).datepicker();
    $( "#datepicker2" ).datepicker();
});
</script>


@endsection

@section('content')

{!! Form::open(['url' => 'summary']) !!}
<div>
	<label>Report Starting From: </label>
	{!! Form::text('date1','', array('id' => 'datepicker1')) !!}
	<label>Until:</label>
	{!! Form::text('date2','', array('id' => 'datepicker2')) !!}
	{!! Form::submit('Generate Report') !!}
    {!! Form::submit('Send Notification') !!}

</div>
{!! Form::close() !!}

<hr>


@if (isset($shifts))
<h4>Results for Shifts Between {{$input['date1']}} and {{$input['date2']}}</h4>

@foreach($shifts as $shift)
@if($shift->name != $name)
 <?php $name = $shift->name; $count = 0; $sum = 0; ?>
 <div class="datagrid">
    <table id="hours">
        <thead>
            <tr>
                <th>Name</th>
                <th>Start of Shift</th>
                <th>End of Shift</th>   
                <th>Hours Payable</th>  
                <th>Overtime Hours</th>      
            </tr>
        </thead>

        <tbody>

            @foreach ($shifts as $shift)
            @if($shift->name == $name)
            <?php $count += $shift->payableHours; $sum += $shift->overtimeHours; $total += $shift->payableHours; $total += $shift->overtimeHours?>
            <tr>
                <td>{{$shift->name}}</td>
                <td>{{$shift->startShift}}</td>
                <td>{{$shift->endShift}}</td>
                <td class="hours">{{$shift->payableHours}}</td>
                <td>{{$shift->overtimeHours}}</td>
            </tr>
            @endif
            @endforeach
            <tr>
                <td>Total Hours</td>
                <td></td>
                <td></td>
                <td id="totalHours">{{$count}}</td>
                <td>{{$sum}}</td>
            </tr>
        </tbody>
    </table>
    <div id="sum"> <div>
    <br>
    <br>
@endif
@endforeach

</div>
@else 

@endif
@if (isset($total))
<h4>The total hours assigned during this pay period: {{$total}}</h4>
@endif

<br>
<br>
@endsection