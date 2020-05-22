<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Model\Admin;
use App\Model\Employer;

class AdminController extends BaseController
{
    public function createAdmin(Admin $admin)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed'
        ]);

        $data = request(['name', 'email', 'password']);
        $data['password'] = app('hash')->make($data['password']);

        $admin->create($data);

        return response()->json([], 201);
    }

    public function createEmployer(Employer $employer)
    {
        $this->validate(request(), [
            'name' => 'required',
            'description' => 'required',
            'email' => 'required|email|unique:employers',
            'password' => 'required|min:6|confirmed'
        ]);

        $data = request(['name', 'description', 'email', 'password']);
        $data['password'] = app('hash')->make($data['password']);

        $employer->create($data);

        return response()->json([], 201);
    }
}
