<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\IUserRepository;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository extends AbstractRepository implements IUserRepository
{

}
