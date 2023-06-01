<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Location;
use App\Models\LocationImage;
use Tests\TestCase;

class LocationTest extends TestCase
{
    /**
     * @test
     */
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
}
