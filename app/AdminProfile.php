<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    /**
     * Mass assignment values
     */
    protected $fillable = [ 'admin_id', 'state', 'name', 'image' ];
    
    
    /**
     * Retrieves the corresponding Admin model
     * 
     * @return App\Admin Admin object assigned to this profile
     */
    public function admin()
    {
    	return $this->belongsTo('App\Admin'); // Checked!
    }
}
