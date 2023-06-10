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
final class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_register_a_user(): void
    {
        $postData = RegisterUserRequestFactory::new()->create();

        $response = $this->postJson('/api/auth/register', $postData);

        $response->assertStatus(Response::HTTP_CREATED)
            ->assertJsonStructure(['token']);

        $this->assertDatabaseHas(User::class, [
            'name' => $postData['name'],
            'email' => $postData['email'],
        ]);
    }

    #[Test]
    public function it_validates_required_fields_on_registration(): void
    {
        $response = $this->postJson('/api/register');

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    #[Test]
    public function it_validates_email_field_on_registration(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'password' => 'secret',
            'password_confirmation' => 'secret',
        ];

        $response = $this->postJson('/api/register', $userData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }
}
