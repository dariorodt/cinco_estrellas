<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * Mass assignment attributes
     */
    protected  $fillable = [ 'name', 'email', 'email_verified_at', 'password' ];
    
    /**
     * Get the corresponding profile assigned to this company
     * 
     * @return App\CompanyProfile CompanyProfile class instance
     */
    public function profile()
    {
    	return $this->hasOne('App\CompanyProfile'); // Checked!
    }
    
    /**
     * Get a collection of ratings sent from users to this company
     * 
     * @return App\CompanyRating CompanyRating class instance
     */
    public function ratings()
    {
        return $this->hasMany('App\CompanyRating'); // Checked!
    }
}
