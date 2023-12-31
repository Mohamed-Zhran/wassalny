<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Responder\Interfaces\IApiHttpResponder;
use App\Domain\Services\Interfaces\ITripService;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Trip;
use DB;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    public function __construct(protected ITripService $tripService, protected IApiHttpResponder $apiHttpResponder)
    {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $trips = $this->tripService->index();
        return $this->apiHttpResponder->response(
            message: 'Trips retrieved successfully',
            data: $trips,
        );
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
    public function store(StoreTripRequest $request)
    {
        $this->authorize('create', Trip::class);
        try {
            $trip = $this->tripService->create($request->validated());
            return $this->apiHttpResponder->response(
                message: 'Trip created successfully',
                data: $trip,
            );
        } catch (\Exception $exception) {
            return $this->apiHttpResponder->responseError(
                message: $exception->getMessage(),
                status: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $request, Trip $trip)
    {
        $this->tripService->update($request->validated(), $trip);
        return $this->apiHttpResponder->response(
            message: 'Trip updated successfully',
            data: $trip->fresh(),
        );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return $this->apiHttpResponder->response(message: 'Car is deleted successfully', status: Response::HTTP_NO_CONTENT);
    }
}
