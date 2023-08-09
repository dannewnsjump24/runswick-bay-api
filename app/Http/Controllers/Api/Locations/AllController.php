<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Locations;

use App\Domain\Locations\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class AllController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        return LocationResource::collection(Location::query()->get());
    }
}
