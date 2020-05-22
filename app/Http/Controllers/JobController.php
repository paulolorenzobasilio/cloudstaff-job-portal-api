<?php

namespace App\Http\Controllers;

class JobController extends Controller
{
    protected $employer;

    public function __construct()
    {
        $this->employer = auth()->guard('employer')->user();
    }

    public function index()
    {
        return response()->json($this->employer->jobs()->getResults());
    }
}
