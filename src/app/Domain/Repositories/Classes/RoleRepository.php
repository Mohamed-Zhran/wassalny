<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\IRoleRepository;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;

class RoleRepository extends AbstractRepository implements IRoleRepository
{
}
