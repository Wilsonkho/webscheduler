<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Calendar;
use Request;
use Session;
use Carbon\Carbon;
class CalendarController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{

	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateShift $request)
	{

		$user = \Auth::user();	
		$input = Request::all();
		// return $check = DB::table('timeOffs')->get();
		$check = DB::table('timeOffs')
			->where('groupid',$user['id'])
			->where('name', $input['name'])
			->where('status','Approved')
			->where('date', $input['date'])
			->get();

		if ($check){

			$user = \Auth::user();
			//return a list of all employees in the user's group
			$employees = DB::table('users')
				->where('groupid',$user['id'])
				->orwhere('id',$user['id'])
				->orderBy('name')
				->get();

			$shifts = DB::table('calendars')
				->where('groupid',$user['id'])
				->orwhere('groupid',$user['groupid'])
				->get();

			return view('home')
				->with('user',$user)
				->with('employees',$employees)
				->with('shifts',$shifts)
				->with('dayOffError',"You have approved that employee to have that day off!");
		}
		$payableHours = strtotime($input['endShift'])-strtotime($input['startShift']);
		$overtimeHours = 0;
		//check for unpaid breaks
		if ($payableHours >= 18000){
		 	$payableHours = $payableHours - 1800;
		}
		//check for overtime hours and format accordingly
		if ($payableHours > 28800){
			$overtimeHours = $payableHours - 28800;
			$overtimeHours = $overtimeHours/3600;
			$payableHours = 28800;
		}
		// $payableHours = date('h:i',$payableHours);
		$payableHours = $payableHours/3600;

		$calendar = new Calendar;
		$calendar->name = $input['name'];
		$calendar->groupid = $user->id;
		$calendar->startShift = new Carbon($input['date']." ".$input['startShift']);
		$calendar->endShift = new Carbon($input['date']." ".$input['endShift']);
		$calendar->shiftDate = $input['date'];
		$calendar->payableHours = $payableHours;
		$calendar->overtimeHours = $overtimeHours;

		$calendar->save();

		return redirect('home');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$calendar = Calendar::findOrFail($id);
		return view('calendarEdit',compact('calendar'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Requests\CreateShift $request)
	{
		$input = Request::all();

		$payableHours = strtotime($input['endShift'])-strtotime($input['startShift']);
		$overtimeHours = 0;
		//check for unpaid breaks
		if ($payableHours >= 18000){
		 	$payableHours = $payableHours - 1800;
		}
		//check for overtime hours and format accordingly
		if ($payableHours > 28800){
			$overtimeHours = $payableHours - 28800;
			$overtimeHours = $overtimeHours/3600;
			$payableHours = 28800;
		}
		$payableHours = $payableHours/3600;
		
		$calendar = Calendar::findOrFail($id);
		$calendar->startShift = new Carbon($input['date']." ".$input['startShift']);
		$calendar->endShift = new Carbon ($input['date']." ".$input['endShift']);
		$calendar->payableHours = $payableHours;
		$calendar->overtimeHours = $overtimeHours;
		$calendar->shiftDate = $input['date'];		
		$calendar->save();

		return redirect('home');		
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$calendar = Calendar::find($id);
        $calendar->delete();
        // redirect
        Session::flash('message', 'Successfully deleted!');
        return redirect('home');
	}

}
