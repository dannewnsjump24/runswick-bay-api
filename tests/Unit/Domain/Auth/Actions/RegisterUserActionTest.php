<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\RegisterUserAction;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class RegisterUserActionTest extends TestCase
{
    use WithFaker;

    #[Test]
    public function it_registers_a_user(): void
    {
        $registerUserAction = app()->make(RegisterUserAction::class);

        $email = $this->faker->email();

        $requestData = [
            'email' => $email,
            'password' => 'password1',
        ];

        $this->assertDatabaseCount(User::class, 0);

        $registerUserAction->execute($requestData);

        $this->assertDatabaseHas(
            User::class,
            [
                'email' => $email,
            ]
        );
    }
}
