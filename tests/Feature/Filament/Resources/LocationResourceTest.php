<?php

declare(strict_types=1);

namespace Tests\Feature\Filament\Resources;

use App\Domain\Locations\Models\Location;
use App\Domain\Locations\Models\LocationImage;
use App\Domain\Trips\Models\Trip;
use App\Filament\Resources\LocationResource\Pages\CreateLocation;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LocationResourceTest extends TestCase
{
    #[Test]
    public function can_store_images_with_location(): void
    {
        $trip = Trip::factory()->create();

        Livewire::test(CreateLocation::class)
            ->fillForm([
                'trip_id' => $trip->id,
                'name' => 'Location Name',
                'latitude' => 50,
                'longitude' => 60,
                'images' => [
                    '0' => [
                        'path' => [
                            'location/location-image.jpg',
                        ],
                    ],
                ],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas(Location::class, [
            'trip_id' => $trip->id,
            'name' => 'Location Name',
            'latitude' => 50,
            'longitude' => 60,
        ]);

        $this->assertDatabaseHas(LocationImage::class, [
            'path' => 'location/location-image.jpg',
            'name' => 'location-image.jpg',
        ]);
    }
}
