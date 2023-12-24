<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Responder\Interfaces\IApiHttpResponder;
use App\Domain\Services\Interfaces\IUserService;

class UserController extends Controller
{
    public function __construct(protected IUserService $userService, protected IApiHttpResponder $apiHttpResponder)
    {
    }

    public function index()
    {
        return $this->apiHttpResponder->response(data: $this->userService->index());
    }
}
