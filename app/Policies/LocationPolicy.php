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
        /** @var \App\Domain\Trips\Models\Trip $trip */
        $trip = $location->trip;

        if (!$trip instanceof Trip) {
            return false;
        }

        return $user->id === $trip->owner_id;
    }

    public function destroy(User $user, Location $location): bool
    {
        /** @var \App\Domain\Trips\Models\Trip $trip */
        $trip = $location->trip;

        if (!$trip instanceof Trip) {
            return false;
        }

        return $user->id === $trip->owner_id;
    }
}
