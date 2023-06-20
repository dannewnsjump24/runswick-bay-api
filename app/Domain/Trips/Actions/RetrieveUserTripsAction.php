<?php

declare(strict_types=1);

namespace App\Domain\Trips\Actions;

use App\Domain\Trips\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

final class RetrieveUserTripsAction
{
    public function __construct(protected Trip $trip)
    {
    }

    /**
     * @return Collection<int, Trip>
     */
    public function execute(int $userId): Collection
    {
        return $this->trip->query()->where('owner_id', '=', $userId)->get();
    }
}
