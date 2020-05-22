<?php

namespace App\Http\Controllers\Auth;

use Laravel\Lumen\Routing\Controller as BaseController;

class EmployerController extends BaseController
{
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

    public function me()
    {
        $user = auth()->guard('employer')->user();
        return response()->json($user);
    }

    public function logout(){
        auth()->guard('employer')->logout();

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
