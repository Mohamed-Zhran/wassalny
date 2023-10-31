<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\IRoleRepository;
use App\Domain\Services\Interfaces\IUserService;

class UserService implements IUserService {
    /**
     * @param RoleRepository $roleRepository
     */
    public function __construct(protected IRoleRepository $roleRepository) {}

    public function index() {
        return $this->roleRepository->findAll();
    }
}
