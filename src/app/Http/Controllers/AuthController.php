<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        return response($request->safe());
    }

    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->safe()->only(['email', 'password']))) {
            return response()->json($request->user()->createToken('authToken')->plainTextToken);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
