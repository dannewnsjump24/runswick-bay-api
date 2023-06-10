<?php

declare(strict_types=1);

namespace App\Exceptions\Auth;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

final class UserRegistrationException extends Exception
{
    /**
     * @param Request $request
     * @return JsonResponse|\Illuminate\Http\Response|\Symfony\Component\HttpFoundation\Response
     * @throws Throwable
     */
    public function render(Request $request): JsonResponse
    {
        return response()->json(
            [
                'error' => 'There was an error registering the user with the provided details',
                'status_code' => Response::HTTP_BAD_REQUEST,
            ],
            Response::HTTP_BAD_REQUEST,
        );
    }
}
