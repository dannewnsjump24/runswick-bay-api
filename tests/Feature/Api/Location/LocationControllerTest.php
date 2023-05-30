<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Location;

use App\Http\Resources\LocationResource;
use App\Models\Location;
use App\Models\LocationImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class LocationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function not_found_returned_when_trying_to_access_location_that_doesnt_exist(): void
    {
        $response = $this->get(route('api.locations.single-location', 100));

        $response->assertNotFound();
    }

    /** @test */
    public function correct_location_returned_when_one_is_found_with_no_images(): void
    {
        $location = Location::factory()->create();

        $response = $this->get(route('api.locations.single-location', $location->id));

        $response->assertOk();

        $response->assertJsonFragment($location->toArray());

        $response->assertJsonMissing(['images']);
    }

    /** @test */
    public function correct_location_returned_with_images_when_images_are_associated(): void
    {
        $location = Location::factory()->create();

        $locationImage = LocationImage::factory()->create(['location_id' => $location->id]);

        $response = $this->get(route('api.locations.single-location', $location->id));

        $response->assertOk();

        $response->assertJsonFragment($location->toArray());
        
        $response->assertJsonCount(1, 'data.images');
    }
}
