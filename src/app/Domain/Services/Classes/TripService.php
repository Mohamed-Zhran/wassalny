<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\ITripRepository;
use App\Domain\Services\Interfaces\ITripService;
use App\Models\Trip;
use App\Models\TripUser;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MatanYadaev\EloquentSpatial\Objects\Point;

class TripService implements ITripService
{
    /**
     * @param  TripRepository  $tripRepository
     */
    public function __construct(protected ITripRepository $tripRepository)
    {
    }

    public function index(): Collection
    {
        return auth()->user()->trips;
    }

    public function create(array $data): mixed
    {
        DB::beginTransaction();
        try {
            $trip = $this->tripRepository->create($data);
            $trip->users()->attach(auth()->id());
            DB::commit();
            return $trip;
        } catch (\Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
    }

    public function update(array $data, Trip $trip): mixed
    {
        return $trip->update($data);
    }

    public function bookTrip(Trip $trip): void
    {
        auth()->user()->trips()->attach($trip->id);
    }
}
