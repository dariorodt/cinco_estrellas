<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
	use Notifiable;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'email', 'rut', 'phone_number', 'password',
	];

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
	 * Get the Client Profile associated with this User instance
	 *
	 * @return App\ClientProfile ClientProfile class instance
	 */
	public function profile()
	{
		return $this->hasOne('App\ClientProfile'); // Checked!
	}

	/**
	 * Get the collection of Client Ratings sent from workers to this user
	 *
	 * @return App\ClientRating ClientRating class instance
	 */
	public function ratings()
	{
		return $this->hasMany('App\ClientRating', 'client_id'); // Checked!
	}

	/**
	 * Get the collection of ratings sent from this user to workers
	 *
	 * @return App\WorkerRating WorkerRating class instance
	 */
	public function worker_ratings()
	{
		return $this->hasMany('App\WorkerRating'); // Checked!
	}

	/**
	 * Get a collection of rating sent from this user to Companies
	 *
	 * @return App\CompanyRating CompanyRating class instance
	 */
	public function company_ratings()
	{
		return $this->hasMany('App\CompanyRating'); // Checked!
	}

	/**
	 * Get a collection of documents uploaded by this user
	 *
	 * @return App\Document Document class instance
	 */
	public function documents()
	{
		return $this->hasMany('App\Document'); // Checked!
	}

	/**
	 * Get a collection of the service orders sent by this client
	 *
	 * @return \Illuminate\Support\Collection
	 */
	public function service_orders()
	{
		return $this->hasMany('App\ServiceOrder'); // Checked!
	}
	
	/**
	 * Get a collection of Payment class objects
	 * 
	 * @return Collection Payment class objects collection
	 */
	public function payments()
	{
		return $this->hasMany(Payment::class); // Checked!
	}
	
	/**
	 * Get a Collection of Message class instances
	 * 
	 * @return Collection	Message class instances collection
	 */
	public function messages()
	{
		return $this->hasMany(Message::class); // Checked!
	}
}
