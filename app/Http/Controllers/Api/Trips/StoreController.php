<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Trips;

use App\Domain\Images\Actions\StoreTripCoverPhotoAction;
use App\Domain\Trips\Actions\StoreAction;
use App\Domain\Trips\Actions\UpdateAction;
use App\Domain\Trips\Models\Trip;
use App\Exceptions\Trip\CreateTripException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trips\StoreRequest;
use App\Http\Resources\TripResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Support\Facades\Log;

final class StoreController extends Controller
{
    public function __invoke(
        StoreRequest $request,
        StoreAction $storeAction,
        StoreTripCoverPhotoAction $storeTripCoverPhotoAction,
        UpdateAction $updateTripAction
    ): TripResource {
        try {
            DB::beginTransaction();
            $tripData = $request->validated();

            $tripData['owner_id'] = $request->user()->id;

            $trip = $storeAction->execute($tripData);

            if (!$trip instanceof Trip) {
                throw new CreateTripException();
            }

            if ($request->hasFile('cover_photo')) {
                $uploadedFile = $request->file('cover_photo');

                if ($uploadedFile instanceof UploadedFile) {
                    $tripCoverImageLocation = "{$trip->id}/cover_image/";

                    $coverPhotoFileName = "{$trip->id}_cover_photo.{$uploadedFile->getClientOriginalExtension()}";

                    $coverPhotoFileName = $storeTripCoverPhotoAction->execute($uploadedFile, $tripCoverImageLocation, $coverPhotoFileName);

                    $updateTripAction->execute($trip, [
                        'cover_photo' => $coverPhotoFileName,
                    ]);
                }
            }
            $trip->refresh();

            DB::commit();

            return new TripResource($trip);
        } catch (Throwable $e) {
            DB::rollback();

            Log::error(__CLASS__, ['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()]);

            throw new CreateTripException();
        }
    }
}
