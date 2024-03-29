<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Trips;

use App\Domain\Trips\Models\Trip;
use App\Http\Controllers\Controller;
use App\Http\Resources\TripResource;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

final class IndexController extends Controller
{
    public function __invoke(): AnonymousResourceCollection
    {
        $trips = Trip::query()->where('owner_id', '=', (int) auth()->id())->paginate();

        return TripResource::collection($trips);
    }
}
