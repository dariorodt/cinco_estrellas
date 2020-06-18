<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
	
	/**
	 * Mass assignment attributes
	 */
	protected $fillable = [ 'user_id', 'name', 'comment', 'file_type', 'file_path' ];
	
	
	/**
	 * Retieves the corresponding User assigned to this document
	 * 
	 * @return App\User User class instance
	 */
	public function user()
	{
		return $this->belongsTo('App\User'); // Checked!
	}
}
