<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerRating extends Model
{
	/**
	 * Mass assignment attributes
	 */
	protected $fillable = [ 'service_order_id', 'worker_id', 'sender_id', 'stars', 'comment' ];
	
	/**
	 * Get the service order where this job was required
	 * 
	 * @return ServiceOrder 
	 */
	public function service_order()
	{
		return $this->belongsTo(ServiceOrder::class);
	}
	
	/**
	 * Retrieves the corresponding User model 
	 * 
	 * @return App\User User class instance
	 */
	public function user()
	{
		return $this->belongsTo('App\User', 'sender_id'); // Checked!
	}
	
	/**
	 * Retrieves the corresponding Worker who sends the rating comment
	 * 
	 * @return App\Worker Worker class instance
	 */
	public function worker()
	{
		return $this->belongsTo('App\Worker'); // Checked!
	}
}
