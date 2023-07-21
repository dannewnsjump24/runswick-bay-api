<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Location;

use App\Domain\Locations\Actions\StoreLocationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Locations\StoreRequest;
use App\Http\Resources\LocationResource;

final class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, StoreLocationAction $createLocationAction): LocationResource
    {

        return new LocationResource($location);
    }
}
