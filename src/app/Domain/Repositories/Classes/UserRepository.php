<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository implements IUserRepository
{
/**
 * Undocumented function
 *
 * @param User $user
 */
    public function __construct(protected User $user)
    {

    }

    /**
     * Find all records.
     *
     * @return Collection
     */
    public function findAll(): Collection {
        return $this->user->all();
    }

}
