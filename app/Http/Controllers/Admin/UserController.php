<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\ServiceOrder;

class UserController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth:admin');
	}
	
	/**
	 * Show complete User/Client list
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request)
	{
		$users = User::all();
		
		return view('admin.users', [
			'users' => $users
		]);
	}
	
	/**
	 * 
	 */
	public function show_new_users()
	{
		
		// Get all inactive users and send it to the view
		$all_users = User::all();
		
		$users = [];
		
		foreach ($all_users as $user) {
			if ($user->profile && $user->profile->status == 'inactive') {
				array_push($users, $user);
			}
		}
		
		return view('admin.users', ['users' => $users]);
	}
	
	/**
	 * 
	 */
	public function show_active_users()
	{
		
		// Get all active users and send it to the view
		$all_users = User::all();
		
		$users = [];
		
		foreach ($all_users as $user) {
			if ($user->profile && $user->profile->status == 'active') {
				array_push($users, $user);
			}
		}
		
		return view('admin.users', ['users' => $users]);
	}
	
	/**
	 * Edit users data
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function edit(User $user)
	{
		//dd($user);
		
		return view('admin.user-edit', ['user' => $user]);
	}
	
	/**
	 * Update user data
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, User $user)
	{
		if ($request->inactive) {
			$user->profile->status = 'inactive';
			$user->profile->save();
		}
		if ($request->active) {
			$user->profile->status = 'active';
			$user->profile->save();
		}
		
		return back();
	}
	
	/**
	 * Delete an user
	 * 
	 * @return \Illuminate\Http\Response
	 */
	public function delete(User $user)
	{
		// TODO: The user deleting must to be a «Soft Delete» (See Laravel Documentation)
		$name = $user->rut;
		
		$user->delete();
		
		return redirect()->route('admin.users')->with('success', 'Se ha borrado con éxito el usuario '.$name);
	}
	
	
	public function jobs()
	{
		return view('admin.user-jobs', [
			'jobs' => ServiceOrder::all(),
		]);
	}
}
