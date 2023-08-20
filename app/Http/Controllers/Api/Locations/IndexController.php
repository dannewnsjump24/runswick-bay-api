<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Locations;

use App\Domain\Locations\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $locations = Location::query()
            ->whereHas('trips', function(Builder $query)  {
                $query->where('ownder_id', '=', (int)auth()->id());
            })
            ->paginate();

        return LocationResource::collection($locations);
    }
}
