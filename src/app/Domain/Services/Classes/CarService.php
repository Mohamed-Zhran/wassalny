<?php

declare(strict_types=1);

namespace App\Domain\Services\Classes;

use App\Domain\Repositories\Interfaces\ICarRepository;
use App\Domain\Services\Interfaces\ICarService;

class CarService implements ICarService
{
    /**
     * @param  CarRepository  $carRepository
     */
    public function __construct(protected ICarRepository $carRepository)
    {
    }

    public function index()
    {
        return $this->carRepository->findAll();
    }

    public function create(array $data): mixed
    {
        return auth()->user()->car()->create($data);
    }

    public function update(array $data):mixed
    {
        return auth()->user()->car->update($data);
    }
    public function delete(): void
    {
        auth()->user()->car->delete();
    }
}
