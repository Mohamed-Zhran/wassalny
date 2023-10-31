<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\IUserRepository;
use App\Domain\Services\Interfaces\IUserService;

class UserService implements IUserService {
    /**
     * @param UserRepository $userRepository
     */
    public function __construct(protected IUserRepository $userRepository) {}

    public function index() {
        return $this->userRepository->findAll();
    }
}
