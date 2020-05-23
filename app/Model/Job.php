<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'title_slug', 'description', 'requirements', 'location', 'salary_min',
        'salary_max', 'employer_id'
    ];
    
    protected static function booted()
    {
        static::creating(function ($job){
            $titleSlug = $job->attributes['title'] . "-" . time();
            $job->attributes['title_slug'] = Str::slug($titleSlug);
        });
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function job_applicants(){
        return $this->hasMany(JobApplicant::class);
    }

    public function setTitleAttribute($value){
        $this->attributes['title'] = Str::title($value);
    }
}
