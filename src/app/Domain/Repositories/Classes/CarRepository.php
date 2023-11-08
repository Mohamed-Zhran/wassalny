<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\ICarRepository;
use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;

class CarRepository extends AbstractRepository implements ICarRepository
{
}
