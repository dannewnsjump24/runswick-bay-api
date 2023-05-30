<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Location;

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
}
