<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Auth;

use App\Http\Requests\RegisterUserRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use PHPUnit\Framework\Attributes\Test;
use Tests\RequestFactories\RegisterUserRequestFactory;
use Tests\TestCase;

final class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_registers_the_user_on_submission(): void
    {
        RegisterUserRequestFactory::new()->fake();

        $response = $this->post('/api/auth/register');

        $response->assertStatus(Response::HTTP_CREATED);
    }
}
