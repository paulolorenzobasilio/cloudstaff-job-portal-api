<?php

namespace App\Http\Controllers;

class JobController extends Controller
{
    private $employer;
    private $jobs;

    public function __construct()
    {
        $this->employer = auth()->guard('employer')->user();
        $this->jobs = $this->employer->jobs()->getResults();
    }

    public function index()
    {
        return response()->json($this->jobs);
    }

    public function show($id)
    {
        return response()->json($this->jobs->find($id));
    }
}
