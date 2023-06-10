<?php

declare(strict_types=1);

namespace App\Domain\Auth\Actions;

use App\Exceptions\UserNotFoundException;
use App\Models\User;

class LoginUserAction
{
    public function __construct(protected User $user)
    {
    }

    /**
     * @param string $email
     * @param string $password
     * @return User
     * @throws UserNotFoundException
     */
    public function execute(string $email, string $password): User
    {
        $user = $this->user->query()->where('email', '=', $email)->first();

        if (!$user instanceof User) {
            throw new UserNotFoundException();
        }

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
    }
}
