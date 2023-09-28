<?php

declare(strict_types=1);

namespace App\Domain\Trips\Jobs;

use App\Domain\Images\Actions\DeleteImageAction;
use App\Domain\Locations\Models\Location;
use App\Domain\Locations\Models\LocationImage;
use App\Domain\Trips\Models\Trip;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteExpiredTripAndContentJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected DeleteImageAction $deleteImageAction;

    public function __construct(protected Trip $trip)
    {
        $this->deleteImageAction = app(DeleteImageAction::class);
    }

    public function handle(): void
    {
        $this->deleteAllLocationAndImages();

        if ($this->trip->cover_photo) {
            $this->deleteImageAction->execute($this->trip->cover_photo, config('filesystems.default'));
        }
        
        $this->trip->forceDelete();
    }

    protected function deleteAllLocationAndImages(): void
    {
        $this->trip->locations->each(function (Location $location) {
            $location->images->each(function (LocationImage $image) {
                if (!$image->path) {
                    return;
                }

                $this->deleteImageAction->execute($image->path, config('filesystems.default'));
            });

            $location->images()->forceDelete();
            
            $location->forceDelete();
        });
    }
}
