<?php

namespace App\Http\Controllers\Auth;

use Laravel\Lumen\Routing\Controller as BaseController;

abstract class AuthController extends BaseController
{
    protected $guard = 'admin';

    abstract public function login();

    public function me()
    {
        $user = auth()->guard($this->guard)->user();
        
        return response()->json($user);
    }

    public function logout()
    {
        auth()->guard($this->guard)->logout();

        return response()->json(['message' => 'Successfully logged out.']);
    }

    protected function sendLoginResponse($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }
}
