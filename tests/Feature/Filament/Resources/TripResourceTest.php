<?php

declare(strict_types=1);

namespace Tests\Feature\Filament\Resources;

use App\Domain\Locations\Models\Location;
use App\Domain\Trips\Models\Trip;
use App\Filament\Resources\TripResource\Pages\ListTrips;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TripResourceTest extends TestCase
{
    #[Test]
    public function can_list_trips(): void
    {
        $trips = Trip::factory()->count(2)->create([
            'start_date' => '2023-06-20 10:00:00',
            'end_date' => '2023-06-27 20:00:00',
        ]);

        $trip = $trips->first();

        Location::factory()->create([
            'trip_id' => $trip->id
        ]);

        Livewire::test(ListTrips::class)
            ->assertCanRenderTableColumn('name')
            ->assertCanRenderTableColumn('owner.name')
            ->assertCanRenderTableColumn('start_date')
            ->assertCanRenderTableColumn('end_date')
            ->assertCanRenderTableColumn('Locations')
            ->assertTableColumnFormattedStateSet('start_date', '2023-06-20', $trip)
            ->assertTableColumnFormattedStateSet('end_date', '2023-06-27', $trip)
//            ->assertTableColumnFormattedStateSet('Locations', collect([$location]), $trip->fresh())
            ->assertCanSeeTableRecords($trips);
    }

}
