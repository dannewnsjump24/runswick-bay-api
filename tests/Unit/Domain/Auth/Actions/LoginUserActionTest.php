<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Auth\Actions;

use App\Domain\Auth\Actions\LoginUserAction;
use App\Exceptions\UserNotFoundException;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Authentication")]
class LoginUserActionTest extends TestCase
{
    use WithFaker;

    #[Test]
    public function it_throws_a_validation_error_when_no_user_is_found(): void
    {
        $email = $this->faker->email();

        $password = $this->faker->password(9);

        $userLoginAction = app()->make(LoginUserAction::class);

        $this->assertThrows(
            fn () => $userLoginAction->execute($email, $password),
            UserNotFoundException::class
        );
    }
}
