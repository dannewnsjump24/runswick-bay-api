<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Location;

use App\Http\Controllers\Controller;
use App\Http\Requests\Locations\StoreRequest;

final class CreateController extends Controller
{
    public function __invoke(StoreRequest $request): void
    {
    }
}
