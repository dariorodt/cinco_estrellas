<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    /**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'user_id', 'worker_id', 'order_id', 'token_ws', 'authorization_code', 'payment_type', 'shares_amount', 'shares_number', 'payment_date', 'card_number', 'card_expire_date', 'worker_paid', 'amount'
	];
	
	/**
	 * Get the associated client
	 * 
	 * @return App\User User class instance
	 */
	public function client()
	{
		return $this->belongsTo(User::class, 'user_id');
	}
	
	/**
	 * Get the worker hired for this job
	 * 
	 * @return App\Worker Worker class instance
	 */
	public function worker()
	{
		return $this->belongsTo(Worker::class);
	}
	
	/**
	 * Get the service order associated
	 * @return App\ServiceOrder ServiceOrder class instance
	 */
	public function order()
	{
		return $this->belongsTo(ServiceOrder::class, 'order_id');
	}
}
