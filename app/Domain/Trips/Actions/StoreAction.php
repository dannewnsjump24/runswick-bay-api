<?php

declare(strict_types=1);

namespace App\Domain\Trips\Actions;

use App\Domain\Trips\Models\Trip;

final class StoreAction
{
    public function __construct(protected Trip $trip)
    {
    }

    public function execute(array $tripCreationData): ?Trip
    {
        return $this->trip->create($tripCreationData);
    }
}
