<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Location;

use App\Domain\Locations\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;

final class ViewController extends Controller
{
    public function __invoke(Location $location): LocationResource
    {
        $location->load('images');

        return new LocationResource($location);
    }
}
