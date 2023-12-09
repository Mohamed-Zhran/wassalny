<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Services\Interfaces\IUserService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function __construct(protected IUserService $userService)
    {
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->userService->create($request->safe()->except(['password_confirmation']));
        $user->load('role');

        return response()->json(['message' => 'User created successfully', 'data' => new UserResource($user)], Response::HTTP_CREATED);
    }

    public function login(LoginRequest $request): JsonResponse
    {
        if (auth()->attempt($request->safe()->only(['email', 'password']))) {
            return response()->json($request->user()->createToken('authToken')->plainTextToken);
        } else {
            return response()->json(['message' => 'Unauthaorized'], 401);
        }
    }
}
