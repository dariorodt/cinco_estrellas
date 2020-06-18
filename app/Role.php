<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	/**
	 * Mass assignment attributes
	 */
	protected $fillable = [ 'name', 'access_level' ];
	
	
	
    /**
     * Get a collection of users that belongs to this role
     * 
     * @return Collection Collection of Admin class instances
     */
    public function admins()
    {
    	return $this->hasMany('App\Admin'); // Checked!
    }
}
