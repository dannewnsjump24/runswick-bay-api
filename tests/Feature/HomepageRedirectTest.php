<?php

declare(strict_types=1);

namespace Tests\Feature;

use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('Redirect')]
class HomepageRedirectTest extends TestCase
{
    #[Test]
    public function it_should_redirect_when_hitting_base_url(): void
    {
        $response = $this->get('/');

        $response->assertRedirect(route('api.ping'));
    }
}
