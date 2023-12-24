<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Responder\Interfaces\IApiHttpResponder;
use App\Domain\Services\Interfaces\ICarService;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    public function __construct(protected ICarService $carService, protected IApiHttpResponder $apiHttpResponder)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $this->authorize('create', Car::class);
        $this->carService->create($request->validated());

        return $this->apiHttpResponder->response(message: 'Car is created successfully', status: Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        return $this->apiHttpResponder->response(data: $car, status: Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $this->authorize('update', $car);
        $this->carService->update($request->validated());

        return $this->apiHttpResponder->response(message: 'Car is updated successfully', data: $car->refresh(), status: Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);
        $this->carService->delete();
        return $this->apiHttpResponder->response(message: 'Car is deleted successfully', status: Response::HTTP_NO_CONTENT);
    }
}
