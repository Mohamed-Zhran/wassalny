<?php

namespace App\Http\Controllers;

use App\Domain\Responder\Interfaces\IApiHttpResponder;
use App\Domain\Services\Interfaces\ITripService;
use App\Models\Trip;

class BookTripController extends Controller
{
    public function __construct(protected ITripService $tripService, protected IApiHttpResponder $apiHttpResponder)
    {
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(Trip $trip)
    {
        $this->authorize('book', $trip);
        $this->tripService->bookTrip($trip);
        return $this->apiHttpResponder->response(message: 'You have successfully booked this trip.');
    }
}
