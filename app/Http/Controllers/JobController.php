<?php

namespace App\Http\Controllers;

class JobController extends Controller
{
    private $employer;
    private $jobs;

    public function __construct()
    {
        $this->employer = auth()->guard('employer')->user();
        $this->jobs = $this->employer->jobs();
    }

    public function index()
    {
        return response()->json($this->jobs->getResults());
    }

    public function show($id)
    {
        $job = $this->jobs->getResults()->find($id);
        return response()->json($job);
    }

    public function create()
    {
        $this->validate(request(), [
            'title' => 'required',
            'description' => 'required',
            'requirements' => 'required',
            'location' => 'required',
            'salary_min' => 'required|numeric',
            'salary_max' => 'required|numeric|gt:salary_min'
        ]);

        $data = request([
            'title', 'description', 'requirements', 'location',
            'salary_min', 'salary_max'
        ]);

        $this->jobs->create($data);

        return response()->json([], 201);
    }
}
