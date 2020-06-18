<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'job_id', 'worker_id', 'user_id', 'sender', 'body'
	];
	
	/**
	 * Get a ServiceOrder class instance related to this Message
	 * 
	 * @return ServiceOrder
	 */
	public function order()
	{
		return $this->belongsTo(ServiceOrder::class, 'job_id');
	}
	
	/**
	 * Get a User class instance related to this message
	 * @return User
	 */
	public function user()
	{
		return $this->belongsTo(User::class); // Checked!
	}
	
	/**
	 * Get a Worker class instance related to this message
	 * 
	 * @return Worker
	 */
	public function worker()
	{
		return $this->belongsTo(Worker::class); // Checked!
	}
}
