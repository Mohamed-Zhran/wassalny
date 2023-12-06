<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Services\Interfaces\IUserService;

class UserController extends Controller
{
    public function __construct(protected IUserService $userService)
    {
    }

    public function index()
    {
        return response()->json($this->userService->index());
    }
}
