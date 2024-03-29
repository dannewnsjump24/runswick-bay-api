<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Auth\Actions\RegisterUserAction;
use App\Exceptions\Auth\TokenGenerationException;
use App\Exceptions\Auth\UserRegistrationException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Laravel\Sanctum\NewAccessToken;

final class RegisterController extends Controller
{
    public function __invoke(RegisterUserRequest $request, RegisterUserAction $registerUserAction): JsonResponse
    {
        $user = $registerUserAction->execute($request->validated());

        if (! $user instanceof User) {
            throw new UserRegistrationException();
        }

        $token = $user->createToken($request->string('device_name')->toString());

        if (! $token instanceof NewAccessToken) {
            throw new TokenGenerationException();
        }

        return response()->json([
            'token' => $token->plainTextToken,
        ], Response::HTTP_CREATED);
    }
}
