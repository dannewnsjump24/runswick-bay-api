<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Location;

use App\Domain\Locations\Models\Location;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

final class DeleteController extends Controller
{
    public function __invoke(Location $location): JsonResponse
    {
        $location->delete();

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
