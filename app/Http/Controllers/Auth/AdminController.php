<?php

namespace App\Http\Controllers\Auth;

class AdminController extends AuthController
{
    protected $guard = 'admin';
    
    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->sendLoginResponse($token);
    }
}
