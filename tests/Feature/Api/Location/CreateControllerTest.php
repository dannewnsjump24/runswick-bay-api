<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Location;

use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Locations")]
class CreateControllerTest extends TestCase
{
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
    }
}
