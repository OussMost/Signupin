<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

class AuthController extends BaseController
{

    public function login(LoginRequest $request)
    {
        if (!auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
        ])) {
            return $this->sendErrorResponse(['message' => 'identifiants Incorrect']);
        }

        $token = auth()->user()->createToken('token')->accessToken;

        return $this->sendOkResponse(['user' => auth()->user(), 'token' => $token]);
    }
}
