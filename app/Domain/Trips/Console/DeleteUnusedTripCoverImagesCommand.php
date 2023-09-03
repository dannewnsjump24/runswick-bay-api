<?php

declare(strict_types=1);

namespace App\Domain\Trips\Console;

use App\Domain\Trips\Models\Trip;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class DeleteUnusedTripCoverImagesCommand extends Command
{
    protected $signature = 'trips:unused-trip-cover-images';

    protected $description = 'Deletes all unused trip cover images from S3';

    public function handle(): void
    {
        $currentTripCoverImages = Trip::query()->pluck('cover_photo')->toArray();

        collect(Storage::disk(config()->get('filesystems.disks.s3-trip-covers'))->allFiles())
            ->reject(fn (string $file) => in_array($file, $currentTripCoverImages))
            ->each(fn ($file) => Storage::disk(config()->get('filesystems.default')->delete($file)));
    }
}
