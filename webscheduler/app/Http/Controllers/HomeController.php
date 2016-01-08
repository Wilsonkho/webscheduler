<?php namespace App\Http\Controllers;
use DB;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = \Auth::user();
		//return a list of all employees in the user's group
		$employees = DB::table('users')
			->where('groupid',$user['id'])
			->orwhere('id',$user['id'])
			->orderBy('name')
			->get();

		// $shifts = DB::table('calendars')->where('userID', $user->id)->get();
		$shifts = DB::table('calendars')
			->where('groupid',$user['id'])
			->orwhere('groupid',$user['groupid'])
			->orderBy('startShift')
			->get();

		return view('home')->with('user',$user)->with('employees',$employees)->with('shifts',$shifts);
	}

}
