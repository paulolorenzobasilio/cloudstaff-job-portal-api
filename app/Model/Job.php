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
        'salary_max', 'employer_id', 'posted'
    ];

    protected static function booted()
    {
        static::creating(function ($job) {
            $job->attributes['title_slug'] = static::setTitleSlug($job->attributes['title']);
        });

        static::updating(function ($job) {
            $job->attributes['title_slug'] = static::setTitleSlug($job->attributes['title']);
        });
    }

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }

    public function job_applicants()
    {
        return $this->hasMany(JobApplicant::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = Str::title($value);
    }

    public function scopePosted($query)
    {
        return $query->where('posted', 1);
    }

    public function scopeTitleSlug($query, $titleSlug)
    {
        return $query->where('title_slug', $titleSlug);
    }

    private static function setTitleSlug($title){
        return Str::slug($title . "-" . time());
        
    }
}
