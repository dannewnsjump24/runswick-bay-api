<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Auth\Actions;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[Group("Authentication")]
class LoginUserActionTest extends TestCase
{
    #[Test]
    public function it_throws_a_validation_error_when_no_user_is_found(): void
    {

    }
}
