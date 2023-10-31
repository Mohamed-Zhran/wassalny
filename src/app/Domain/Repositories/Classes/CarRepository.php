<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\ICarRepository;
use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;

class CarRepository implements ICarRepository
{
    /**
     * Undocumented function
     *
     * @param Car $car
     */
    public function __construct(protected Car $car)
    {
    }

    /**
     * Find all records.
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->car->all();
    }
}
