<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Locations;

use App\Domain\Locations\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $currentUserId = (int)auth()->id();

        $locations = Location::query()
            ->join('trip', function (JoinClause $join) use ($currentUserId) {
                $join->on('trip.owner_id', '=', 'location.owner_id')->where('trip.owner_id', '=', $currentUserId);
            })
            ->paginate();

        return LocationResource::collection($locations);
    }
}
