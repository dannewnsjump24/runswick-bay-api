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
class DeleteControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_doesnt_delete_a_trip_when_not_authenticated(): void
    {
        $response = $this->deleteJson(route('api.trips.delete'));

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_doesnt_delete_a_trip_for_a_user_that_is_authenticated_but_they_dont_own(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        Trip::factory()->create();

        $response = $this->deleteJson(route('api.trips.delete'));

        $response->assertNotFound();
    }
}
