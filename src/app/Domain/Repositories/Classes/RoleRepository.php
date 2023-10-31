<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\IRoleRepository;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository implements IRoleRepository
{
    /**
     * Undocumented function
     *
     * @param Role $role
     */
    public function __construct(protected Role $role)
    {
    }

    /**
     * Find all records.
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->role->all();
    }
}
