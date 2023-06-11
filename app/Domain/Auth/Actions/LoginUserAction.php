<?php

declare(strict_types=1);

namespace App\Domain\Auth\Actions;

use App\Exceptions\UserNotFoundException;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
dok
class LoginUserAction
{
    public function __construct(protected User $user)
    {
    }

    /**
     * @throws UserNotFoundException
     * @throws ValidationException
     */
    public function execute(string $email, string $password): User
    {
        $user = $this->user->query()->where('email', '=', $email)->first();

        if (!$user instanceof User) {
            throw new UserNotFoundException();
        }

        if (!Hash::check($password, $user->password)) {
            throw ValidationException::withMessages(
                [
                    'email' => ['The provided credentials are incorrect.'],
                ]
            );
        }

        return $user;
    }
}
