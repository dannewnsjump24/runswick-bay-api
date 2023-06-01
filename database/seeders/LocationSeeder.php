<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    public function run(): void
    {
        Location::factory()->create(
            [
                'name' => 'Runswick Bay',
                'latitude' => 54.5322,
                'longitude' => -0.7368,
            ]
        );

        Location::factory()->create(
            [
                'name' => 'RedCar Beach',
                'latitude' => 54.6199,
                'longitude' => -1.0661,
            ]
        );

        Location::factory()->create(
            [
                'name' => 'Saltburn',
                'latitude' => 54.5816,
                'longitude' => -0.9751,
            ]
        );

        Location::factory()->create(
            [
                'name' => 'Whitby',
                'latitude' => 54.4863,
                'longitude' => -0.6133,
            ]
        );

        Location::factory()->create(
            [
                'name' => 'Robin Hood\'s Bay',
                'latitude' => 54.4344,
                'longitude' => -0.5350,
            ]
        );
    }
}
