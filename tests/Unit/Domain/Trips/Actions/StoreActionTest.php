<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Trips\Actions;

use App\Domain\Trips\Actions\StoreAction;
use App\Domain\Trips\Models\Trip;
use App\Exceptions\Trip\CreateTripException;
use App\Models\User;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Trips")]
class StoreActionTest extends TestCase
{
    #[Test]
    /**
     * @test
     */
    public function it_throws_exception_when_failed_creation(): void
    {
        $this->expectException(CreateTripException::class);

        $this->partialMock(Trip::class, function (MockInterface $mock) {
            $mock->shouldReceive('create')->once()->andReturnFalse();
        });

        $action = app()->make(StoreAction::class);

        $action->execute([]);
    }

    #[Test]
    /**
     * @test
     */
    public function it_saves_the_data_to_the_database_correctly(): void
    {
        $action = app()->make(StoreAction::class);

        $user = User::factory()->create();

        $postData = [
            'name' => 'tester',
            'owner_id' => $user->id,
        ];

        $action->execute($postData);

        $this->assertDatabaseCount(
            Trip::class,
            1
        );

        $this->assertDatabaseHas(
            Trip::class,
            [
                'name' => 'tester',
                'owner_id' => $user->id,
            ]
        );
    }
}
