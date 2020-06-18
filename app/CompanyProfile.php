<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyProfile extends Model
{
    /**
     * Mass assignment attributes
     */
    protected $fillable = [ 'user_id', 'state', 'name', 'address', 'phone' ];
    
    /**
     * Get the corresponding Company instance assigned to this profile
     * 
     * @return App\Company Company class instance 
     */
    public function company()
    {
    	return $this->belongsTo('App\Company'); // Checked!
    }
}
