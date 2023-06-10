<?php

declare(strict_types=1);

namespace App\Domain\Auth\Actions;

use App\Models\User;

class RegisterUserAction
{
    public function __construct(protected User $user)
    {
    }

    public function execute(array $registrationData): bool
    {
        $createdUser = $this->user->create($registrationData);

        return $createdUser instanceof User;
    }
}
