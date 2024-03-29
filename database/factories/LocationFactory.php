<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Locations\Models\Location;
use App\Domain\Trips\Models\Trip;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Locations\Models\Location>
 *
 * @mixin \App\Domain\Locations\Models\Location
 */
class LocationFactory extends Factory
{
    protected $model = Location::class;

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
