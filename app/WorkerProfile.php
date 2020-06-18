<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WorkerProfile extends Model
{
    /**
     * Mass assignment attributes
     */
    protected $fillable = [ 
        'worker_id', 
        'state', 
        'f_name', 
        'l_name', 
        'birthday', 
        'phone', 
        'gender', 
        'nationality', 
        'comunity', 
        'city', 
        'street', 
        'block', 
        'about_me', 
        'image_path',
    ];
    
    /**
     * Get the worker to which this profile belongs
     * 
     * @return App\Worker Worker class instance
     */
    public function worker()
    {
    	return $this->belongsTo('App\Worker'); // Checked!
    }
    
    /**
     * Concatenate the first name and the last name to get a full name
     * 
     * @return string
     */
    public function full_name()
    {
        return $this->f_name.' '.$this->l_name;
    }
}
