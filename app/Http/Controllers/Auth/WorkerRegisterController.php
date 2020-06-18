<?php

namespace App\Http\Controllers\Auth;

use App\Worker;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;


class WorkerRegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	protected $redirectTo = '/worker';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}
	
	/**
	 * Returns de guard for user authorization
	 */
	protected function guard()
	{
		return Auth::guard('worker');
	}
	
	/**
	 * Show the application registration form.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function showRegistrationForm()
	{
		return view('auth.worker-register');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'email' => ['required', 'string', 'email', 'max:255', 'unique:workers'],
			'rut' => ['required', 'regex:/\d{7,8}-\d{1}/', 'unique:workers'],
			'phone_number' => ['required', 'string', 'max:12', 'unique:workers'],
			'password' => ['required', 'string', 'min:8', 'confirmed'],
		]);
	}
	
	/**
	 * Handle a registration request for the application.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function register(Request $request)
	{
		$this->validator($request->all())->validate();
		
		event(new Registered($worker = $this->create($request->all())));
		
		$this->guard('worker')->login($worker);
		
		return $this->registered($request, $worker)
						?: redirect($this->redirectPath());
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return \App\Worker
	 */
	protected function create(array $data)
	{
		return Worker::create([
			'email' => $data['email'],
			'rut' => $data['rut'],
			'phone_number' => $data['phone_number'],
			'password' => Hash::make($data['password']),
		]);
	}
}
