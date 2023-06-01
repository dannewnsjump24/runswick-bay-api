<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Locations;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class AllController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        return LocationResource::collection(Location::query()->get());
    }
}
