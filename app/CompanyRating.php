<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyRating extends Model
{
	/**
	 * Mass assignment attributes
	 */
	protected $fillable = [ 'client_id', 'sender_id', 'stars', 'coment' ];
	
	
	/**
	 * Retrieves the corresponding User model
	 * 
	 * @return App\User User class instance
	 */
	public function user()
	{
		return $this->belongsTo('App\User'); // Checked!
	}
	
	
	/**
	 * Retrieves the cooresponding Company model
	 * 
	 * @return App\Company Company class instance
	 */
	public function company()
	{
		return $this->belongsTo('App\Company'); // Checked!
	}
}
