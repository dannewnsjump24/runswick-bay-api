<?php

declare(strict_types=1);

namespace Tests\RequestFactories\Location;

use App\Domain\Trips\Models\Trip;
use Worksome\RequestFactories\RequestFactory;

class StoreRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'trip_id' => Trip::factory(),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];
    }
}
