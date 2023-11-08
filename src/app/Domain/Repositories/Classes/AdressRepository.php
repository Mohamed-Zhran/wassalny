<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\IAddressRepository;
use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

class AddressRepository extends AbstractRepository implements IAddressRepository
{
}
