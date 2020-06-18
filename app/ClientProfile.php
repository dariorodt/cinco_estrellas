<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientProfile extends Model
{
	/**
	 * Mass assignment attributes
	 */
	protected $fillable = [ 'user_id', 'status', 'f_name', 'l_name', 'rut', 'birthday', 'phone', 'gender', 'nationality' ];
	
	
	/**
	 * Retrieves the corresponding User model
	 * 
	 * @return App\User User model assigned to this profile
	 */
	public function user()
	{
		return $this->belongsTo('App\User'); // Checked!
	}
	
	public function full_name()
	{
		return $this->f_name.' '.$this->l_name;
	}
}
