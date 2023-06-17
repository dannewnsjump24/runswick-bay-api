<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Trips;

use App\Http\Controllers\Controller;
use App\Http\Requests\Trips\StoreRequest;

final class StoreController extends Controller
{
    public function __invoke(StoreRequest $request): void
    {
    }
}
