<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserNotFoundException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'error' => 'The user could not be found',
                'status_code' => Response::HTTP_BAD_REQUEST,
            ],
            Response::HTTP_BAD_REQUEST,
        );
    }
}
