<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerPayment extends Model
{
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'worker_id', 'service_order_id', 'f_name', 'l_name', 'rut', 'bank', 'account', 'email', 'amount',
	];
	
	/**
	 * Get the Worker related to this payment
	 * 
	 * @return App\Worker 
	 */
	public function worker()
	{
		return $this->belongsTo(Worker::class);
	}
	
	/**
	 * Get the service order related to this payment
	 * 
	 * @return App\ServiceOrder
	 */
	public function service_order()
	{
		return $this->belongsTo(ServiceOrder::class);
	}
	
	/**
	 * Return the full name of the person who receives the payment
	 * 
	 * @return string
	 */
	public function full_name()
	{
		return $this->f_name.' '.$this->l_name;
	}
}
