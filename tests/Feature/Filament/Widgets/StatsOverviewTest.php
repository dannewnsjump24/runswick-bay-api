<?php

declare(strict_types=1);

namespace Tests\Feature\Filament\Widgets;

use App\Domain\Locations\Models\Location;
use App\Domain\Trips\Models\Trip;
use App\Filament\Widgets\StatsOverview;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget\Stat;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StatsOverviewTest extends TestCase
{
    #[Test]
    public function will_generate_default_stats_for_dashboard(): void
    {
        $widget = new StatsOverview();

        $this->assertEquals(
            [
                new Stat('Trips', 0),
                new Stat('Users', 0),
                new Stat('Locations', 0),
            ],
            invade($widget)->getStats()
        );
    }

    #[Test]
    public function will_generate_counts_when_data_is_present(): void
    {
        $widget = new StatsOverview();

        $user = User::factory()->create();

        $trip = Trip::factory()->create([
            'owner_id' => $user->id,
        ]);

        Location::factory()->create([
            'trip_id' => $trip->id,
        ]);

        $this->assertEquals(
            [
                new Stat('Trips', 1),
                new Stat('Users', 1),
                new Stat('Locations', 1),
            ],
            invade($widget)->getStats()
        );
    }
}
