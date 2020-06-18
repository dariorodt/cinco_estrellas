<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceOrder extends Model
{
	/**
	 * Mass assignment asstributes
	 */
	protected $fillable = [ 'user_id', 'worker_id', 'admin_id', 'service_id', 'status', 'starting_date', 'ending_date', 'starting_time', 'ending_time', 'region', 'comunity', 'city', 'aditional_info' ];
	
	
	/**
	 * Get the client who sent this service order
	 * 
	 * @return \App\User User class instance
	 */
	public function client()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	
	/**
	 * Get the worker who accepted this service order
	 * 
	 * @return \App\Worker Worker class instance
	 */
	public function worker()
	{
		return $this->belongsTo(Worker::class);
	}
	
	/**
	 * Get the service required on this order
	 * 
	 * @return \App\Service Service class instance
	 */
	public function service()
	{
		return $this->belongsTo(Service::class);
	}
	
	/**
	 * Get the admin who revised and activate this service order
	 * 
	 * @return \App\Admin Admin class instance
	 */
	public function admin()
	{
		return $this->belongsTo(Admin::class);
	}
	
	/**
	 * Get the collection of messages sent to this order.
	 * 
	 * @return Collection
	 */
	public function messages()
	{
		return $this->hasMany(Message::class, 'job_id');
	}
	
	/**
	 * Get the collection of applicacions this order have.
	 * 
	 * @return Collection
	 */
	public function applications()
	{
		return $this->hasMany(Application::class, 'job_id');
	}
	
	/**
	 * Get a collection of Payment class objects
	 * 
	 * @return Collection Payment class objects collection
	 */
	public function payment()
	{
		return $this->hasOne(Payment::class);
	}
	
	/**
	 * Get the worker rating related with this order
	 * 
	 * @return WorkerRating
	 */
	public function worker_rating()
	{
		return $this->hasOne(WorkerRating::class);
	}
	
	/**
	 * Get the client rating related with this order
	 * 
	 * @return ClientRating 
	 */
	public function client_rating()
	{
		return $this->hasOne(ClientRating::class);
	}
}
