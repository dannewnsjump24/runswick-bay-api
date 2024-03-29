<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Location;

use App\Domain\Locations\Models\Location;
use App\Domain\Trips\Models\Trip;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('Locations')]
class StoreControllerTest extends TestCase
{
    use WithFaker;

    #[Test]
    public function it_wont_allow_an_unauthenticated_user_to_create_a_location(): void
    {
        $response = $this->postJson(route('api.locations.store'), []);

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_will_fail_validation_when_trying_to_create_a_location(): void
    {
        $postData = [];

        Sanctum::actingAs(User::factory()->create());

        $response = $this->postJson(route('api.locations.store'), $postData);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrors(
            [
                'latitude',
                'longitude',
                'name',
                'trip_id',
            ]
        );
    }

    #[Test]
    public function it_wont_allow_a_user_to_create_a_location_against_a_trip_they_dont_own(): void
    {
        $user = User::factory()->create();

        $userTwo = User::factory()->create();

        /** @var Trip $trip */
        $trip = Trip::factory()->create(
            [
                'owner_id' => $userTwo->id,
            ]
        );

        Sanctum::actingAs($user);

        $locationData = [
            'trip_id' => $trip->id,
            'name' => 'south wales',
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];

        $response = $this->postJson(route('api.locations.store'), $locationData);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrorFor('trip_id');
    }

    #[Test]
    public function it_wont_allow_a_invalid_lat_long_to_save(): void
    {
        $user = User::factory()->create();

        $userTwo = User::factory()->create();

        /** @var Trip $trip */
        $trip = Trip::factory()->create(
            [
                'owner_id' => $userTwo->id,
            ]
        );

        Sanctum::actingAs($user);

        $locationData = [
            'trip_id' => $trip->id,
            'name' => 'south wales',
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
        ];

        $response = $this->postJson(route('api.locations.store'), $locationData);

        $response->assertUnprocessable();

        $response->assertJsonValidationErrorFor('trip_id');
    }

    #[Test]
    public function it_will_create_a_valid_location_for_the_user_who_owns_the_tripe(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        /** @var Trip $trip */
        $trip = Trip::factory()->create(
            [
                'owner_id' => $user->id,
            ]
        );

        Sanctum::actingAs($user);

        $lat = $this->faker->latitude();
        $long = $this->faker->longitude();

        $locationData = [
            'trip_id' => $trip->id,
            'name' => 'south wales',
            'latitude' => $lat,
            'longitude' => $long,
        ];

        $response = $this->postJson(route('api.locations.store'), $locationData);

        $response->assertCreated()
            ->assertJson(function (AssertableJson $json) use ($locationData) {
                $json->has('data.trip_id')->where('data.trip_id', $locationData['trip_id']);
            });

        $this->assertDatabaseHas(
            Location::class,
            [
                'name' => 'south wales',
                'latitude' => $lat,
                'longitude' => $long,
                'trip_id' => $trip->id,
            ]
        );
    }
}
