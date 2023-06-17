<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class TokenGenerationException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'error' => 'There was an error generating the authentication token.',
            ],
            Response::HTTP_BAD_REQUEST,
        );
    }
}
