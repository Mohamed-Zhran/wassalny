<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\ITripRepository;
use App\Domain\Services\Interfaces\ITripService;

class TripService implements ITripService {
    /**
     * @param TripRepository $tripRepository
     */
    public function __construct(protected ITripRepository $tripRepository) {}

    public function index() {
        return $this->tripRepository->findAll();
    }
}
