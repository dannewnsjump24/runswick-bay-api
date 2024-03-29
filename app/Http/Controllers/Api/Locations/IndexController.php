<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Locations;

use App\Domain\Locations\Models\Location;
use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $locations = Location::query()
            ->whereHas('trip', function (Builder $query) {
                $query->where('owner_id', '=', (int) auth()->id());
            })
            ->paginate();

        return LocationResource::collection($locations);
    }
}
