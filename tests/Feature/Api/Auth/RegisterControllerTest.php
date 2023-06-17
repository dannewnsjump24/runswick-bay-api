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

        $response->assertCreated()
            ->assertJsonStructure(['token']);

        $this->assertDatabaseHas(User::class, [
            'name' => $postData['name'],
            'email' => $postData['email'],
        ]);
    }

    #[Test]
    public function it_validates_required_fields_on_registration(): void
    {
        $response = $this->postJson('/api/auth/register', []);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['name', 'email', 'password']);
    }

    #[Test]
    public function it_validates_email_field_on_registration(): void
    {
        $userData = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'password' => 'secretonemore',
            'device_name' => 'tester_device',
        ];

        $response = $this->postJson('/api/auth/register', $userData);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['email'])
            ->assertJsonMissingValidationErrors(['name', 'password']);
    }

    #[Test]
    public function it_cannot_register_a_user_who_is_already_registered(): void
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userData = [
            'name' => 'John Doe',
            'email' => $user->email,
            'password' => 'morethaneight',
            'device_name' => 'tester_device',
        ];

        $response = $this->postJson('/api/auth/register', $userData);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['email'])
            ->assertJsonMissingValidationErrors(['name', 'password']);
    }
}
