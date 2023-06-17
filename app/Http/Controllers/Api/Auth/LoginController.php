<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Auth;

use App\Domain\Auth\Actions\LoginUserAction;
use App\Exceptions\UserNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

final class LoginController extends Controller
{
    public function __invoke(LoginUserRequest $request, LoginUserAction $loginUserAction): JsonResponse
    {
        try {
            $user = $loginUserAction->execute($request->string('email')->toString(), $request->string('password')->toString());

            return response()->json([
                'token' => $user->createToken($request->string('device')->toString())->plainTextToken,
            ], Response::HTTP_OK);
        } catch (UserNotFoundException $exception) {
            throw ValidationException::withMessages(
                [
                    'email' => ['The provided credentials are incorrect.'],
                ]
            );
        }
    }
}
