<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

final class PingController extends Controller
{
    public function __invoke(): JsonResponse
    {
        return response()->json(
            [
                'service' => config('app.name'),
                'timestamp' => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        );
    }
}
