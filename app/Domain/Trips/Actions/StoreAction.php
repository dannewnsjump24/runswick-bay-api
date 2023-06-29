<?php

declare(strict_types=1);

namespace App\Domain\Trips\Actions;

use App\Domain\Trips\Models\Trip;
use App\Exceptions\Trip\CreateTripException;

final class StoreAction
{
    public function __construct(protected Trip $trip)
    {
    }

    /**
     * @throws \App\Exceptions\Trip\CreateTripException
     */
    public function execute(array $tripCreationData): Trip
    {
        $createResult = $this->trip->create($tripCreationData);

        throw_unless($createResult instanceof Trip, CreateTripException::class);

        return $createResult;
    }
}
