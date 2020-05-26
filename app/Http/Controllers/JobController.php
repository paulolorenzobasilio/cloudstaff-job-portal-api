<?php

namespace App\Http\Controllers;

use App\Model\Job;
use App\Services\S3;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Laravel\Lumen\Routing\Controller as BaseController;

class JobController extends BaseController
{
    public function index(Job $job)
    {
        $jobs = $job->posted()->paginate(15);
        return response()->json($jobs);
    }

    public function show(Job $job, $slug)
    {
        $jobPosting = $job->titleSlug($slug)->first();
        return response()->json($jobPosting);
    }

    public function apply(Job $job, S3 $s3, $slug)
    {
        $jobPosting = $job->titleSlug($slug)->first();

        if (is_null($jobPosting)) {
            throw new ModelNotFoundException("Job not found");
        }

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'resume' => 'required|file'
        ]);

        $data = request(['name', 'email']);
        $data['resume_link'] = $s3->put(request()->file('resume'));

        $jobApplicants = $jobPosting->job_applicants();
        
        if ($this->checkIfJobApplicantAlreadyApplied($jobApplicants, $data["email"])) {
            throw new Exception('Job applicant already applied on this job.');
        }

        $jobApplicants->create($data);

        return response()->json([], 201);
    }

    private function checkIfJobApplicantAlreadyApplied($jobApplicants, $email)
    {
        return $jobApplicants->getResults()->where('email', $email)->isNotEmpty();
    }
}
