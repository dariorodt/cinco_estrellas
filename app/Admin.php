<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    
	/**
	 * Mass assignment attributes
	 */
    protected $fillable = [ 'role_id', 'name', 'email', 'password' ];
    
    /**
     * Authentication guard
     */
    protected $guard = 'admin';
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    /**
     * Retrives the coresponding Role model
     * 
     * @return App\Role Role object assigned to this Admin
     */
    public function role()
    {
    	return $this->belongsTo('App\Role'); // Checked!
    }
    
    /**
     * Get the Admin Profile asociated with this Admin instance
     * 
     * @return App\AdminProfile AdminProfile class instance
     */
    public function profile()
    {
        return $this->hasOne('App\AdminProfile'); // Checked!
    }
    
    /**
     * Get a collection of service orders revised and activated by this admin
     * 
     * @return \Illuminate\Support\Collection   A collection of App\ServiceOrders class instances
     */
    public function service_orders()
    {
        return $this->hasMany(ServiceOrders::class);
    }
}
