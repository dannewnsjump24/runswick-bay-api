<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Location;

use App\Http\Resources\LocationResource;
use App\Models\Location;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

    public function correct_location_returned_when_one_is_found(): void
    {
        $location = Location::factory()->create();

        $response = $this->get(route('api.locations.single-location', $location->id));

        $locationResource = new LocationResource($location);

        $response->assertOk();

        $response->assertJsonCount(1, 'data');

        $response->assertJsonFragment($locationResource->toArray());
    }
}
