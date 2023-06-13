<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\RegisterUserRequestFactory;
use Tests\TestCase;

#[Group("Authentication")]
final class LoginControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_throws_validation_error_when_not_actual_user_trying_to_login(): void
    {
        $postData = RegisterUserRequestFactory::new()->create();

        $response = $this->postJson('/api/auth/login', $postData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    #[Test]
    public function it_throws_validation_error_when_actual_user_trying_to_login_with_invalid_password(): void
    {
        User::factory()->create([
            'password' => '123sdfdsfdsf3'
        ]);

        $postData = RegisterUserRequestFactory::new()->create();

        $response = $this->postJson('/api/auth/login', $postData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
