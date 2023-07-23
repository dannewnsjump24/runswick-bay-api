<?php

declare(strict_types=1);

namespace App\Exceptions\Location;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateLocationException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => 'There was an error creating the location.',
            ],
            Response::HTTP_BAD_REQUEST,
        );
    }
}
