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
use Illuminate\Support\Facades\DB;

final class StoreController extends Controller
{
    public function __invoke(
        StoreRequest $request,
        StoreAction $storeAction,
        StoreTripCoverPhotoAction $storeTripCoverPhotoAction,
        UpdateAction $updateTripAction
    ): void {
        DB::transaction(static function () use ($storeAction, $request, $storeTripCoverPhotoAction, $updateTripAction) {
            $tripData = $request->validated();

            $tripData['owner_id'] = $request->user()->id;

            $trip = $storeAction->execute($tripData);

            if (!$trip instanceof Trip) {
                throw new CreateTripException();
            }

            if ($request->hasFile('cover_photo')) {
                $uploadedFile = $request->file('cover_photo');

                $tripCoverImageLocation = "{$trip->id}/cover_image/";

                $coverPhotoFileName = "{$trip->id}_cover_photo.{$uploadedFile->getClientOriginalExtension()}";

                $coverPhotoFileName = $storeTripCoverPhotoAction->execute($uploadedFile, $tripCoverImageLocation, $coverPhotoFileName);

                $updateTripAction->execute($trip, ['cover_photo' => $coverPhotoFileName]);
            }
        });
        //wrap this code in a transaction to clear up after itself if it fails
        //create the trip
        //check if there is a file uploaded
        //upload the image using the disk.
        //@todo look at if we can move the image upload to a job
        //$storeAction->execute();
    }
}
