<?php

namespace App\Model;

use App\Jobs\Job;
use Illuminate\Database\Eloquent\Model;

class JobApplicant extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['job_id', 'name', 'email', 'resume_link'];

    public function job(){
        return $this->belongsTo(Job::class);
    }

}
