<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\ITripRepository;
use App\Domain\Services\Interfaces\ITripService;
use App\Models\Trip;
use MatanYadaev\EloquentSpatial\Objects\Point;

class TripService implements ITripService
{
    /**
     * @param  TripRepository  $tripRepository
     */
    public function __construct(protected ITripRepository $tripRepository)
    {
    }

    public function create(array $data): mixed
    {
        $trip = [
            'beginning' => new Point((float)$data['beginning_lat'], (float)$data['beginning_lng']),
            'destination' => new Point((float)$data['destination_lat'], (float)$data['destination_lng']),
            'available_seats' => $data['available_seats']
        ];

        return $this->tripRepository->create($trip);
    }

    public function update(array $data, Trip $trip): mixed
    {
        return $trip->update([
            'beginning' => new Point((float)$data['beginning_lat'], (float)$data['beginning_lng']),
            'destination' => new Point((float)$data['destination_lat'], (float)$data['destination_lng']),
            'available_seats' => $data['available_seats']
        ]);
    }
}
