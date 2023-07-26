<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Location;

use App\Domain\Locations\Actions\StoreLocationAction;
use App\Domain\Locations\Models\Location;
use App\Exceptions\Location\CreateLocationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Locations\StoreRequest;
use App\Http\Resources\LocationResource;

final class StoreController extends Controller
{
    public function __invoke(StoreRequest $request, StoreLocationAction $createLocationAction): LocationResource
    {
        $location = $createLocationAction->execute($request->toDto());

        throw_unless($location instanceof Location, CreateLocationException::class);

        return new LocationResource($location);
    }
}
