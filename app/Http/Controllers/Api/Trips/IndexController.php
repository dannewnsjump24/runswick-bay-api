<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Trips;

use App\Domain\Trips\Actions\RetrieveUserTripsAction;
use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class IndexController extends Controller
{
    public function __invoke(RetrieveUserTripsAction $retrieveUserTripsAction): AnonymousResourceCollection
    {
        $trips = $retrieveUserTripsAction->execute(auth()->id());

        return TripResource::collection($trips);
    }
}
