<?php

declare(strict_types=1);

namespace App\Domain\Trips\Actions;

use App\Models\User;

class StoreAction
{
    public function __construct(protected User $user)
    {
    }

    public function execute(array $registrationData): ?User
    {
        return $this->user->create($registrationData);
    }
}
