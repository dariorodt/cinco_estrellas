<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
	/**
	 * Mass assignment attributes
	 */
	protected $fillable = [ 'status', 'name', 'description', 'fa_icon' ];
	
	/**
	 * Retrieve the worker associated with this service
	 * 
	 * @return App\Worker Worker class instance
	 */
	public function workers()
	{
		return $this->belongsToMany('App\Worker') // Automatically use service_worker table as pivot.
			// When including Pivot model is needed to give the columns you want to inclide with
			->withPivot('visit_required', 'day_cost', 'night_cost', 'days')
			// Timestamps are included separately
			->withTimestamps();
	}
}
