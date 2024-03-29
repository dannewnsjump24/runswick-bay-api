<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Trips\Models;

use App\Domain\Locations\Models\Location;
use App\Domain\Trips\Models\Trip;
use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('Models')]
final class TripTest extends TestCase
{
    #[Test]
    public function it_returns_correct_relationship(): void
    {
        $user = User::factory()->create();

        $trip = Trip::factory()->create(
            [
                'owner_id' => $user->id,
            ]
        );

        /** @var User $tripOwner */
        $tripOwner = $trip->owner;

        $this->assertTrue($tripOwner->is($user));
    }

    #[Test]
    public function it_returns_empty_when_no_locations(): void
    {
        $user = User::factory()->create();

        $trip = Trip::factory()->create(
            [
                'owner_id' => $user->id,
            ]
        );

        $this->assertEmpty($trip->locations);
    }

    #[Test]
    public function it_returns_no_locations_when_there_are_some_but_no_on_that_trip(): void
    {
        $user = User::factory()->create();

        $trip = Trip::factory()->create(
            [
                'owner_id' => $user->id,
            ]
        );

        $tripTwo = Trip::factory()->create(
            [
                'owner_id' => $user->id,
            ]
        );

        Location::factory()->for($tripTwo)->create();

        $this->assertEmpty($trip->locations);
    }

    #[Test]
    public function it_returns_a_location_for_a_trip(): void
    {
        $user = User::factory()->create();

        $trip = Trip::factory()->create(
            [
                'owner_id' => $user->id,
            ]
        );

        Location::factory()->for($trip)->create();

        $this->assertCount(1, $trip->locations);
    }
}
