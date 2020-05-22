<?php

namespace App\Http\Controllers\Auth;

class EmployerController extends AuthController
{
    protected $guard = 'employer';
    
    public function __construct()
    {
        $this->middleware('auth:employer', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);
        
        if (!$token = auth()->guard('employer')->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->sendLoginResponse($token);
    }
}
