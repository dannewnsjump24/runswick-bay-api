<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Trips\Jobs;

use App\Domain\Locations\Models\Location;
use App\Domain\Locations\Models\LocationImage;
use App\Domain\Trips\Console\DeleteExpiredTripsAndRelatedContentCommand;
use App\Domain\Trips\Models\Trip;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group('Trips')]
class DeleteExpiredTripAndContentJobTest extends TestCase
{
    #[Test]
    public function it_doesnt_deleted_a_trip_that_isnt_marked_as_deleted(): void
    {
        $trip = Trip::factory()->create();

        $this->artisan(DeleteExpiredTripsAndRelatedContentCommand::class, [
            'dayToGoBack' => 30,
        ]);
        $this->assertDatabaseHas(
            Trip::class,
            [
                'id' => $trip->id,
                'deleted_at' => null,
            ]
        );
    }

    #[Test]
    public function it_doesnt_delete_a_trip_that_is_marked_as_deleted_but_is_less_than_the_allotted_days(): void
    {
        $trip = Trip::factory()->create(
            [
                'deleted_at' => now()->subDays(10),
            ]
        );

        $this->artisan(DeleteExpiredTripsAndRelatedContentCommand::class, [
            'dayToGoBack' => 30,
        ]);
        $this->assertSoftDeleted(
            Trip::class,
            [
                'id' => $trip->id,
            ]
        );
    }

    #[Test]
    public function it_does_delete_a_trip_that_is_marked_as_deleted_and_is_in_the_window(): void
    {
        $trip = Trip::factory()->create(
            [
                'deleted_at' => now()->subDays(31),
            ]
        );

        $this->artisan(DeleteExpiredTripsAndRelatedContentCommand::class, [
            'dayToGoBack' => 30,
        ]);
        $this->assertDatabaseMissing(
            Trip::class,
            [
                'id' => $trip->id,
            ]
        );
    }

    #[Test]
    public function it_does_delete_locations_that_are_part_of_a_trip_being_deleted(): void
    {
        $trip = Trip::factory()->create(
            [
                'deleted_at' => now()->subDays(31),
            ]
        );

        $location = Location::factory()->for($trip)->create();

        $this->artisan(DeleteExpiredTripsAndRelatedContentCommand::class, [
            'dayToGoBack' => 30,
        ]);

        $this->assertDatabaseMissing(
            Trip::class,
            [
                'id' => $trip->id,
            ]
        );

        $this->assertDatabaseMissing(
            Location::class,
            [
                'id' => $location->id,
                'trip_id' => $trip->id,
            ]
        );
    }

    #[Test]
    public function it_deletes_the_cover_photo_when_deleting_the_trip(): void
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->create('hello.jpg');

        Storage::putFileAs('tester-location', $file, 'hello.jpg');

        $trip = Trip::factory()->create([
            'deleted_at' => now()->subDays(31),
            'cover_photo' => 'tester-location/hello.jpg',
        ]);

        $this->artisan(DeleteExpiredTripsAndRelatedContentCommand::class, [
            'dayToGoBack' => 30,
        ]);

        Storage::assertMissing('tester-location/hello.jpg');
    }

    #[Test]
    public function it_doesnt_delete_the_cover_photo_not_deleting_the_trip(): void
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->create('hello.jpg');

        Storage::putFileAs('tester-location', $file, 'hello.jpg');

        $trip = Trip::factory()->create([
            'deleted_at' => now()->subDays(10),
            'cover_photo' => 'tester-location/hello.jpg',
        ]);

        $this->artisan(DeleteExpiredTripsAndRelatedContentCommand::class, [
            'dayToGoBack' => 30,
        ]);

        Storage::assertExists('tester-location/hello.jpg');
    }

    #[Test]
    public function it_does_delete_location_images_that_are_part_of_a_location_being_deleted(): void
    {
        $fileA = UploadedFile::fake()->create('file-a.jpg');

        Storage::putFileAs('tester-location', $fileA, 'file-a.jpg');

        $fileB = UploadedFile::fake()->create('file-b.jpg');

        Storage::putFileAs('tester-location', $fileB, 'file-b.jpg');

        $trip = Trip::factory()->create([
            'deleted_at' => now()->subDays(31),
        ]);

        $location = Location::factory()
            ->for($trip)
            ->has(LocationImage::factory()->state([
                'path' => 'tester-location/file-a.jpg',
            ]), 'images')
            ->has(LocationImage::factory()->state([
                'path' => 'tester-location/file-b.jpg',
            ]), 'images')
            ->create();

        $this->artisan(DeleteExpiredTripsAndRelatedContentCommand::class, [
            'dayToGoBack' => 30,
        ]);

        Storage::assertMissing('tester-location/file-a.jpg');

        Storage::assertMissing('tester-location/file-b.jpg');

        $this->assertDatabaseEmpty(LocationImage::class);
    }
}
