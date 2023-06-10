<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Locations;

use Database\Seeders\LocationSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Tests\TestCase;

class AllControllerTest extends TestCase
{
    use DatabaseMigrations;
    /**
     * @test
     */
    public function all_locations_are_returned(): void
    {
        $this->seed(LocationSeeder::class);

        $response = $this->getJson('/api/locations');

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(5, 'data');
    }

    /**
     * @test
     */
    public function no_locations_are_returned_when_none_exist(): void
    {
        $response = $this->getJson('/api/locations');

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(0, 'data');
    }
}
