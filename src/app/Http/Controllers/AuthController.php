<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (auth()->attempt($request->safe()->only(['email', 'password']))) {
            return response()->json($request->user()->createToken('authToken')->plainTextToken);
        } else {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
    }
}
