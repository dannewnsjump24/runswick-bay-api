<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Locations;

use App\Domain\Locations\Models\Location;
use App\Domain\Trips\Models\Trip;
use App\Models\User;
use Database\Seeders\LocationSeeder;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Http\Response;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('Locations')]
class IndexControllerTest extends TestCase
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
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $location = Location::factory()
            ->for(Trip::factory()->create([
                'owner_id' => $user->id,
            ]))
            ->create();

        $this->seeder(LocationSeeder::class);

        $response = $this->getJson('/api/locations');

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(1, 'data');

        $response->assertJsonPath('data.0.name', $location->name);
    }

    #[Test]
    public function only_owned_locations_are_returned(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $location = Location::factory()
            ->for(Trip::factory()->create())
            ->create();

        $this->seeder(LocationSeeder::class);

        $response = $this->getJson('/api/locations');

        $response->assertStatus(Response::HTTP_OK);

        $response->assertJsonCount(0, 'data');
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
