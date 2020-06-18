<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Worker extends Authenticatable implements MustVerifyEmail
{
	use Notifiable;
	
	/**
	 * Authentication guard
	 */
	protected $guard = 'worker';
	
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
	 * By Dario Rodriguez <dariorodt@gmail.com>
	 * This method overwrites the original located in the MustVerifyEmail 
	 * trait to use a diferent notification class.
	 * Send the email verification notification.
	 *
	 * @return void
	 */
	public function sendEmailVerificationNotification()
	{
		// $this->notify(new Notifications\VerifyEmail);
		$this->notify(new \App\Notifications\WorkerVerifyEmail);
	}
	
	/**
	 * Get the Worker Profile associated with this Worker instance
	 * 
	 * @return App\WorkerProfile WorkerProfile class instance
	 */
	public function profile()
	{
		return $this->hasOne('App\WorkerProfile'); // Checked!
	}
	
	/**
	 * Get a collection of documents uploaded by this worker
	 * 
	 * @return Collection
	 */
	public function documents()
	{
		return $this->hasMany(WorkerDocument::class); // Checked!
	}
	
	/**
	 * Get a collection of Worker Ratings sent from users to this worker
	 * 
	 * @return App\WorkerRating WorkerRating class instance
	 */
	public function ratings()
	{
		return $this->hasMany('App\WorkerRating'); // Checked!
	}
	
	/**
	 * Get a collection of Client Rating sent from this worker to users
	 * 
	 * @return App\ClientRating ClientRating class instance
	 */
	public function client_ratings()
	{
		return $this->hasMany('App\ClientRating'); // Checked!
	}
	
	/**
	 * Get a collections of services that belongs to this worker
	 * 
	 * @return \Illuminate\Support\collection 	A collection of App\Service class instances
	 */
	public function services()
	{
		return $this->belongsToMany('App\Service') // Use service_worker table as pivot.
			// When including Pivot model is needed to give the columns you want to inclide with
			->withPivot('visit_required', 'day_cost', 'night_cost', 'days')
			// Timestamps incluided separately
			->withTimestamps();
	}
	
	/**
	 * Get a collection of service orders accepted by this worker
	 * 
	 * @return \Illuminate\Support\Collection 	A collection of ServiceOrders class instances
	 */
	public function service_orders()
	{
		return $this->hasMany(ServiceOrder::class);
	}
	
	/**
	 * Get the collection of application this worker has
	 * 
	 * @return Collection
	 */
	public function applications()
	{
		return $this->hasMany(Application::class);
	}
	
	/**
	 * Get a collection of Payment class objects
	 * 
	 * @return Collection Payment class instances collection
	 */
	public function payments()
	{
		return $this->hasMany(Payment::class);
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
