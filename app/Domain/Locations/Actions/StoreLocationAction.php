<?php

declare(strict_types=1);

namespace App\Domain\Locations\Actions;

use App\Domain\Locations\Models\Location;

class StoreLocationAction
{
    public function __construct(protected Location $locationModel)
    {
    }

    public function execute(array $locationData): ?Location
    {
        return $this->locationModel->create($locationData);
    }
}
