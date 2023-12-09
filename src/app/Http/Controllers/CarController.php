<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Services\Interfaces\ICarService;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use Symfony\Component\HttpFoundation\Response;

class CarController extends Controller
{
    public function __construct(protected ICarService $carService)
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
        $this->carService->create($request->validated());

        return response()->json('Car is created successfully', Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
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
        $this->carService->update($request->validated(), $car->id);

        return response()->json(['message' => 'Car is updated successfully', 'data' => $car->refresh()], Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        $this->carService->delete($car->id);

        return response()->json('Car is deleted successfully', Response::HTTP_NO_CONTENT);
    }
}
