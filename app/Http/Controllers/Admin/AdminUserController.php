<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Admin;
use App\AdminProfile;

class AdminUserController extends Controller
{
	/**
	 * Create a new contrroller instance
	 * 
	 * @return void
	 */
    public function __construct()
    {
    	$this->middleware('auth:admin');
    }
    
    /**
     * Display the whole list of Admin Users
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
    	return view('admin.admins', ['admins' => Admin::all()]);
    }
    
    /**
     * Show the new admin user form
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
    	return view('admin.adminuser-create');
    }
    
    /**
     * Store a new admin user data into the admins table
     * 
     * @param  Request $request
     * @return Illuminate\HTtp\Response
     */
	public function store(Request $request)
	{
		$request->validate([
			'role_id' => 'required|integer',
			'name' => 'required|string|unique:admins',
			'email' => 'required|email|unique:admins',
			'password' => 'required|confirmed',
		]);
		
		Admin::create([
			'role_id' => $request->role_id,
			'name' => $request->name,
			'email' => $request->email,
			'password' => Hash::make($request->password),
		]);
		
		return redirect()->route('admin.adminusers')->with('success', 'Usuario creado correctamente');
	}
	
	public function create_profile(Admin $admin)
	{
		return view('admin.adminuser-create-profile', ['admin' => $admin]);
	}
	
	public function store_profile(Request $request, Admin $admin)
	{
		$request->validate([
			'name' => 'required|string',
			'image' => 'required|image'
		]);
		
		$profile = new AdminProfile();
		$profile->admin_id = $admin->id;
		$profile->state = 'active';
		$profile->name = $request->name;
		
		if($request->file('image'))
		{
			$image = $request->file('image');
			$imagename = time().'.'.$image->getClientOriginalExtension();
			$destination_path = public_path('/images/admins/');
			$image->move($destination_path, $imagename);
			$profile->image = 'images/admins/'.$imagename;
		}
		
		$profile->save();
		
		return redirect()->route('admin.adminusers')->with('success', 'Perfil de '.$profile->name.' guardado correctemente');
	}
	
	/**
	 * Show the edit admin user form
	 * 
	 * @param  Admin  $admin
	 * @return Illuminate\Http\Response
	 */
	public function edit(Admin $admin)
	{
		return view('admin.adminuser-edit', ['admin' => $admin]);
	}
	
	
	/**
	 * Update the given admin user data into de admins table
	 * 
	 * @param  Request $request
	 * @param  Admin   $admin
	 * @return Illuminate\Http\Response
	 */
	public function update(Request $request, Admin $admin)
	{
		$request->validate([
			'role_id' => 'required|integer',
			'name' => 'required|string|unique:admins',
			'email' => 'required|email|unique:admins',
		]);
		
		$admin->update($request->input());
		
		return redirect()->route('admin.adminusers')->with('success', 'Administrados actualizado correctamente');
	}
	
	/**
	 * Change the passwors to the given admin user
	 * 
	 * @param  Request $request
	 * @param  Admin   $admin
	 * @return Illuminate\Http\Response
	 */
	public function ch_password(Request $request, Admin $admin)
	{
		if ($request->isMethod('get')) return view('admin.adminuser-change-password', ['admin' => $admin]);
		
		$request->validate(['password' => 'required|confirmed']);
		
		$admin->password = Hash::make($request->password);
		$admin->save();
		
		return redirect()->route('admin.adminusers')->with('success', 'Pasword actualizado correctamente');
	}
	
	/**
	 * Deletes the given admin user
	 * 
	 * @param  Admin  $admin
	 * @return Illuminate\Http\Response
	 */
	public function delete(Admin $admin)
	{
		$name = $admin->name;
		
		if (Auth::user()->role->access_level == 29) {
			if ($admin->id == 1) {
				return back()->with('warning', 'No se puede eliminar al SuperAdmin');
			}
			$admin->delete();
			return back()->with('success', 'Eliminado correctamente usuario '.$name);
		} else {
			return back()->with('warning', 'No tiene sufifiente nivel de acceso para borrar Administradores. Comuníquese con el SuperAdmin');
		}
	}
	
}
