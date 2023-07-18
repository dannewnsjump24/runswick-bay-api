<?php

declare(strict_types=1);

namespace App\Policies;

use App\Domain\Locations\Models\Location;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Location $location): bool
    {
        return $user->id === $location->trip->owner_id;
    }
}
