<?php

declare(strict_types=1);

namespace App\Exceptions\Image;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class DeleteImageException extends Exception
{
    public function render(Request $request): JsonResponse
    {
        return new JsonResponse(
            [
                'message' => 'There was an error deleting the image.',
            ],
            Response::HTTP_BAD_REQUEST,
        );
    }
}
