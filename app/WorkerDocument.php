<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerDocument extends Model
{
	/**
	 * Mass assignment attributes
	 */
	protected $fillable = [ 'worker_id', 'name', 'comment', 'file_type', 'file_path' ];
	
	
	/**
	 * Retieves the corresponding User assigned to this document
	 * 
	 * @return App\User User class instance
	 */
	public function worker()
	{
		return $this->belongsTo('App\Worker'); // Checked!
	}
}
