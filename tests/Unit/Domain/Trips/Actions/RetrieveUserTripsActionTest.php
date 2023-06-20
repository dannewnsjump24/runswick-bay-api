<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Trips\Actions;

use App\Domain\Trips\Actions\RetrieveUserTripsAction;
use App\Domain\Trips\Models\Trip;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Trips")]
#[Group("RetrieveTrip")]
class RetrieveUserTripsActionTest extends TestCase
{
    #[Test]
    public function it_returns_an_empty_collection(): void
    {
        $action = app()->make(RetrieveUserTripsAction::class);

        $result = $action->execute(1);

        $this->assertEmpty($result);
    }

    #[Test]
    public function it_returns_no_element_when_tasks_exist_but_dont_belong_to_the_user(): void
    {
        $trip = Trip::factory()->create();

        $action = app()->make(RetrieveUserTripsAction::class);

        $result = $action->execute(1);

        $this->assertEmpty($result);
    }
}
