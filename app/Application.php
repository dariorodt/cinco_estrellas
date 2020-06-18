<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = ['job_id', 'worker_id'];
    
    /**
     * Get the job to which this application was done
     * 
     * @return App\ServiceOrder ServiceOrder class instance
     */
    public function job()
    {
    	return $this->belongsTo(ServiceOrder::class, 'job_id');
    }
    
    /**
     * Get the worker who made this application
     * 
     * @return App\Worker Worker class instance
     */
    public function worker()
    {
    	return $this->belongsTo(Worker::class);
    }
}
