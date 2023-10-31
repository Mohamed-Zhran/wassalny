<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\IAddressRepository;
use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;

class AddressRepository implements IAddressRepository
{
    /**
     * Undocumented function
     *
     * @param Address $address
     */
    public function __construct(protected Address $address)
    {
    }

    /**
     * Find all records.
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->address->all();
    }
}
