<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Request;
use Session;
use Carbon\Carbon;


class SummaryController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{

		$user = \Auth::user();
		return view('summary')->with('user',$user);
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

		$input = Request::all();
		$user = \Auth::user();
		$date1 = new Carbon($input['date1']);
		$date2 = new Carbon($input['date2']);
		$name = "";
		$count = 0;
		$sum = 0;
		$total = 0;
		//query for shifts between inputs
		$shifts = DB::table('calendars')
			->where('groupid',$user['id'])
			->where('startShift', '>', $date1)
			->where('startShift','<', $date2)
			->orderBy('name','startShift')
			->get();

		return view('summary')->with('shifts', $shifts)->with('user',$user)->with('name',$name)->with('count',$count)->with('sum',$sum)->with('input',$input)->with('total', $total);

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
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
