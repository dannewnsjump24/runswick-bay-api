<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Trips;

use App\Domain\Trips\Models\Trip;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('Trips')]
class ViewControllerTest extends TestCase
{
    #[Test]
    public function it_cannot_retrieve_a_trip_when_not_authorised(): void
    {
        $trip = Trip::factory()->create();

        $response = $this->getJson(route('api.trips.view', $trip->id));

        $response->assertUnauthorized();
    }

    #[Test]
    public function it_cannot_retrieve_a_trip_the_current_user_doesnt_own(): void
    {
        $user = User::factory()->create();

        $trip = Trip::factory()->for($user, 'owner')->create();

        Sanctum::actingAs(User::factory()->create());

        $response = $this->getJson(route('api.trips.view', $trip->id));

        $response->assertForbidden();
    }

    #[Test]
    public function it_receives_a_not_found_when_a_trip_doesnt_exist(): void
    {
        Sanctum::actingAs(User::factory()->create());

        $response = $this->getJson(route('api.trips.view', '121211221'));

        $response->assertNotFound();
    }

    #[Test]
    public function it_cant_retrieve_a_deleted_trip(): void
    {
        $user = User::factory()->create();

        $trip = Trip::factory()->for($user, 'owner')->deleted()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson(route('api.trips.view', $trip->id));

        $response->assertNotFound();
    }

    #[Test]
    public function it_can_retrieve_a_trip_that_the_user_owns(): void
    {
        $user = User::factory()->create();

        $trip = Trip::factory()->for($user, 'owner')->create();

        Sanctum::actingAs($user);

        $response = $this->getJson(route('api.trips.view', $trip->id));

        $response->assertOk()
            ->assertJson(function (AssertableJson $json) use ($trip) {
                $json->has('data.id')->where('data.id', $trip->id);
                $json->has('data.name')->where('data.name', $trip->name);
                $json->has('data.id')->where('data.id', $trip->id);
            });
    }
}
