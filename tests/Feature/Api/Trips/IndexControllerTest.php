<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Trips;

use App\Domain\Trips\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Trips")]
class IndexControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_cannot_retrieve_a_list_of_trip_when_not_authorised(): void
    {
        $response = $this->getJson(route('api.trips.index'));

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_returns_an_empty_collection_on_the_endpoint_when_authorised_and_no_trips(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson(route('api.trips.index'));

        $response->assertOk();

        $response->assertJsonCount(0, 'data');
    }

    #[Test]
    public function it_returns_an_empty_collection_for_a_user_when_there_are_trips_that_belong_to_other_users(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Trip::factory()->create();

        $response = $this->getJson(route('api.trips.index'));

        $response->assertOk();

        $response->assertJsonCount(0, 'data');
    }

    #[Test]
    public function it_return_a_number_of_trips_for_the_current_user_when_there_are_trips_associated_with_that_user(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Trip::factory()->times(4)->create(
            [
                'owner_id' => $user->id,
            ]
        );

        $response = $this->getJson(route('api.trips.index'));

        $response->assertOk();

        $response->assertJsonCount(4, 'data');
    }

    #[Test]
    public function it_returns_only_owners_trips_when_a_combination_of_trips_exist(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Trip::factory()->times(4)->create(
            [
                'owner_id' => $user->id,
            ]
        );

        $userTwo = User::factory()->create();

        Trip::factory()->times(4)->create(
            [
                'owner_id' => $userTwo->id,
            ]
        );

        $response = $this->getJson(route('api.trips.index'));

        $response->assertOk();

        $response->assertJsonCount(4, 'data');
    }

    #[Test]
    public function it_returns_meta_data_for_pagination_when_enough_trips_exist(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Trip::factory()->times(25)->create(
            [
                'owner_id' => $user->id,
            ]
        );

        $userTwo = User::factory()->create();

        Trip::factory()->times(4)->create(
            [
                'owner_id' => $userTwo->id,
            ]
        );

        $response = $this->getJson(route('api.trips.index'));

        $response->assertOk();

        $response->assertJsonCount(15, 'data');

        $response->assertJson(
            [
                'meta' => [
                    "current_page" => 1,
                    "from" => 1,
                    "last_page" => 2,
                    "path" => "http://localhost/api/trips",
                    "per_page" => 15,
                    "to" => 15,
                    "total" => 25,
                ],
            ]
        );
    }
}
