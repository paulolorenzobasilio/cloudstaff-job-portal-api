<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use App\Model\Admin;

class AdminController extends BaseController
{
    private $admin;

    public function __construct(Admin $admin)
    {
        $this->admin = $admin;
    }

    public function createAdmin()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:admins',
            'password' => 'required|min:6|confirmed'
        ]);

        $data = request(['name', 'email', 'password']);

        $this->admin->create($data);

        return response()->json([], 201);
    }
}
