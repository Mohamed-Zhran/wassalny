<?php

namespace App\Http\Controllers;

use App\Domain\Services\Interfaces\IUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(protected IUserService $userService)
    {

    }

    public function index() {
        return response()->json($this->userService->index());
    }
}
