<?php namespace App\Http\Controllers;

use DB;
use App\User;
use App\Http\Requests;
use App\Http\Requests\CreateEmployeeRequest;
use App\Http\Controllers\Controller;
use Session;
// use Illuminate\Http\Request;


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
		return view('employeeCreate');
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
		$input = $request;
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
		$employee = User::findOrFail($id);
		return view('employeeEdit',compact('employee'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id, Requests\CreateEmployeeRequest $request)
	{
		$employee = User::findOrFail($id);
		$employee->update($request->all());
		return redirect('employees');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

        $employee = User::find($id);
        $employee->delete();

        // redirect
        Session::flash('message', 'Employee successfully deleted!');
        return redirect('employees');

	}

}
