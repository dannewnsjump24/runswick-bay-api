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
    public function it_throws_validation_error_when_not_complete_login(): void
    {
        $postData = RegisterUserRequestFactory::new()->create();

        $response = $this->postJson('/api/auth/login', $postData);

        $response->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

    }
}
