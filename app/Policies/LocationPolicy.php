<?php

declare(strict_types=1);

namespace App\Policies;

use App\Domain\Locations\Models\Location;
use App\Domain\Trips\Models\Trip;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LocationPolicy
{
    use HandlesAuthorization;

    public function view(User $user, Location $location): bool
    {
        /** @var Trip $trip */
        $trip = $location->trip;

        return $user->id === $trip->owner_id;
    }
}
