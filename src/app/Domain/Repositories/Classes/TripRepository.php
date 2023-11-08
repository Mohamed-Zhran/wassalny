<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use App\Domain\Repositories\Interfaces\ITripRepository;
use App\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class TripRepository extends AbstractRepository implements ITripRepository
{
}
