<?php

namespace App\Model;

use App\Jobs\Job;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

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

    protected static function booted(){
        static::creating(function($jobApplicant){
            $jobApplicant->attributes['id'] = Uuid::uuid4();
        });
    }

}
