<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Trips;

use App\Domain\Trips\Models\Trip;
use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;

final class RetrieveTripController extends Controller
{
    public function __invoke(Trip $trip): TripResource
    {
        return new TripResource($trip);
    }
}
