<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Trips\Models;

use App\Domain\Trips\Models\Trip;
use App\Models\User;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Models")]
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
}
