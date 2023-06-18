<?php

declare(strict_types=1);

namespace App\Domain\Trips\Actions;

use App\Domain\Trips\Models\Trip;

class UpdateAction
{
    public function execute(Trip $trip, array $tripUpdateData): bool
    {
        return $trip->update($tripUpdateData);
    }
}
