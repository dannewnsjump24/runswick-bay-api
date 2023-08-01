<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Location;

use App\Domain\Locations\Models\Location;
use App\Domain\Trips\Models\Trip;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Locations")]
class DeleteControllerTest extends TestCase
{
    #[Test]
    public function it_cannot_delete_a_loccation_if_not_logged_in(): void
    {
        $location = Location::factory()->create();

        $this->deleteJson(route('api.locations.delete', $location->id))->assertUnauthorized();
    }

    #[Test]
    public function it_cannot_delete_a_location_for_a_location_that_doesnt_exist(): void
    {
        $this->deleteJson(route('api.locations.delete', 'asdadsa'))->assertUnauthorized();
    }

    #[Test]
    public function it_cannot_delete_a_location_if_they_dont_own_it(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $trip = Trip::factory()->create(
            [
                'owner_id' => User::factory(),
            ]
        );

        $location = Location::factory()->for($trip)->create();

        $this->deleteJson(route('api.locations.delete', $location->id))->assertForbidden();
    }

    #[Test]
    public function it_cannot_delete_a_location_thats_already_deleted(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $trip = Trip::factory()->create(
            [
                'owner_id' => $user->id,
            ]
        );

        $location = Location::factory()->for($trip)->create(
            [
                'deleted_at' => now()->subSecond(),
            ]
        );

        $this->deleteJson(route('api.locations.delete', $location->id))->assertNotFound();
    }

    #[Test]
    public function it_can_delete_a_location_that_it_owns(): void
    {
        $user = User::factory()->create();

        $trip = Trip::factory()->create(
            [
                'owner_id' => $user->id,
            ]
        );

        $location = Location::factory()->for($trip)->create();

        Sanctum::actingAs($user);

        $this->deleteJson(route('api.locations.delete', $location->id))->assertNoContent();
    }

    #[Test]
    public function it_cant_delete_a_location_for_a_trip_thats_deleted_but_location_isnt(): void
    {
        $user = User::factory()->create();

        $trip = Trip::factory()->create(
            [
                'owner_id' => $user->id,
                'deleted_at' => now()->subHour(),
            ]
        );

        $location = Location::factory()->for($trip)->create();

        Sanctum::actingAs($user);

        $this->deleteJson(route('api.locations.delete', $location->id))->assertForbidden();
    }
}
