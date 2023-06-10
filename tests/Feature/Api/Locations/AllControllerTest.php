<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Locations;

use App\Models\User;
use Database\Seeders\LocationSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Locations")]
class AllControllerTest extends TestCase
{
    use DatabaseMigrations;

    #[Test]
    public function it_cannot_view_locations_when_not_logged_in(): void
    {
        $response = $this->getJson('/api/locations');

        $response->assertUnauthorized();
    }

    #[Test]
    public function all_locations_are_returned_when_user_is_logged_in(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $this->seed(LocationSeeder::class);

        $response = $this->getJson('/api/locations');

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(5, 'data');
    }

    #[Test]
    public function no_locations_are_returned_when_none_exist(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->getJson('/api/locations');

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(0, 'data');
    }
}
