<?php

declare(strict_types=1);

namespace App\Domain\Locations\Dtos;

class Location
{
    public function __construct(
        public string $name,
        public float $latitude,
        public float $longitude,
    ) {
    }
}
