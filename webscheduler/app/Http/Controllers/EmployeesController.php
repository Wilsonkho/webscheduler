<?php namespace App\Http\Controllers;

use DB;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;


class EmployeesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$user = \Auth::user();
		
		$users = DB::table('users')->where('groupid',$user['id'])->get();
		return view('employees')->with('users',$users);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('create_employee');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Requests\CreateEmployeeRequest $request)
	{
		$user = \Auth::user();
		// $managerid = $user->get('id');
		$input = Request::all();
		User::create([
			'name' => $input['name'],
			'email' => $input['email'],
			'password' => bcrypt($input['password']),
			'position' => $input['position'],
			'groupid' => $user['id'],
			]);
		$users = DB::table('users')->where('groupid',$user['id'])->get();
		return view('employees')->with('users',$users);

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
