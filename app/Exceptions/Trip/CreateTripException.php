<?php

declare(strict_types=1);

namespace App\Exceptions\Trip;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateTripException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => 'There was an error creating the trip.',
            ],
            Response::HTTP_BAD_REQUEST,
        );
    }
}
