<?php

declare(strict_types=1);

namespace App\Domain\Trips\Actions;

use App\Domain\Trips\Models\Trip;
use Illuminate\Database\Eloquent\Collection;

class RetrieveUserTripsAction
{
    public function __construct(protected Trip $trip)
    {
    }

    /**
     * @param int $userId
     * @return Collection<int, Trip>
     */
    public function execute(int $userId): Collection
    {
        return $this->trip->query()->where('owner_id', '=', $userId)->get();
    }
}
