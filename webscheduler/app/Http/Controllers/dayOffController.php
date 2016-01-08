<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Timeoff;
use Request;
use Session;

class dayOffController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = \Auth::user();
		if ($user->position == 'Manager'){
		$timeOffs = DB::table('timeOffs')
			->get();
		}
		else {
		$timeOffs = DB::table('timeOffs')
			->where('name',$user['name'])
			->get();

		}
		return view('dayOff')->with('timeOffs', $timeOffs)->with('user',$user);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$user = \Auth::user();
		$input = Request::all();
		$timeOff = new timeOff;
		$timeOff->groupID = $user->groupid;
		$timeOff->name = $user->name;
		$timeOff->status = 'Pending';
		$timeOff->date = $input['date'];
		$timeOff->save();
		return redirect('dayOff');
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

		$dayOff = Timeoff::findOrFail($id);
		return view('dayOffEdit',compact('dayOff'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$dayoff = Timeoff::findOrFail($id);
		$dayoff->status = "Approved";
		$dayoff->save();
		return redirect('dayOff');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$dayoff = Timeoff::findOrFail($id);
		$dayoff->status = "Declined";
		$dayoff->save();
		return redirect('dayOff');
	}

}
