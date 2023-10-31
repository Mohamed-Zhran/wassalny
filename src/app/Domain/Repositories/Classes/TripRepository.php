<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\ITripRepository;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class TripRepository implements ITripRepository
{
    /**
     * Undocumented function
     *
     * @param Trip $trip
     */
    public function __construct(protected Trip $trip)
    {
    }

    /**
     * Find all records.
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->trip->all();
    }
}
