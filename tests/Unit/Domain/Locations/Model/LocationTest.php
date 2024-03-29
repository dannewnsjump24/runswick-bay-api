<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Locations\Model;

use App\Domain\Locations\Models\Location;
use App\Domain\Locations\Models\LocationImage;
use App\Domain\Trips\Models\Trip;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('Locations')]
class LocationTest extends TestCase
{
    #[Test]
    public function it_does_return_image_from_relationship(): void
    {
        $location = Location::factory()->create();

        LocationImage::factory()->create(
            [
                'location_id' => $location->id,
            ]
        );

        $location->load('images');

        $this->assertCount(1, $location->images);
    }

    #[Test]
    public function it_does_return_a_trip_associated_with_a_location(): void
    {
        $location = Location::factory()->create();

        $this->assertInstanceOf(Trip::class, $location->trip);
    }
}
