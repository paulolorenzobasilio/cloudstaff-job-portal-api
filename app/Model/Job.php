<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

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

    public function employer()
    {
        return $this->belongsTo(Employer::class);
    }
}
