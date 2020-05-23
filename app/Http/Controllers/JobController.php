<?php

namespace App\Http\Controllers;

use App\Model\Job;
use Laravel\Lumen\Routing\Controller as BaseController;

class JobController extends BaseController
{
    public function index(Job $job)
    {
        $jobs = $job->posted()->paginate(15);
        return response()->json($jobs);
    }
}
