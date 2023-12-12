<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Domain\Services\Interfaces\ITripService;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Trip;
use DB;
use Symfony\Component\HttpFoundation\Response;

class TripController extends Controller
{
    public function __construct(protected ITripService $tripService)
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
    public function store(StoreTripRequest $request)
    {
        $trip = $this->tripService->create($request->validated());
        return response()->json([
            'success' => true,
            'message' => 'Trip created successfully',
            'data' => $trip,
        ]);
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
        return response()->json([
            'success' => true,
            'message' => 'Trip updated successfully',
            'data' => $trip->fresh(),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        $trip->delete();
        return response()->json('Car is deleted successfully', Response::HTTP_NO_CONTENT);
    }
}
