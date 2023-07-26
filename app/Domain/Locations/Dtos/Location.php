<?php

declare(strict_types=1);

namespace App\Domain\Locations\Dtos;

class Location
{
    public function __construct(
        public string $tripId,
        public string $name,
        public float $latitude,
        public float $longitude,
    ) {
    }

    public function toArray(): array
    {
        return [
            'trip_id' => $this->tripId,
            'name' => $this->name,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
        ];
    }
}
