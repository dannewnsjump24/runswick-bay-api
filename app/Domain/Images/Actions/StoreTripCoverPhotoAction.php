<?php

declare(strict_types=1);

namespace App\Domain\Images\Actions;

use App\Exceptions\Image\ImageStoreException;
use Illuminate\Http\UploadedFile;

class StoreTripCoverPhotoAction
{
    /**
     * @throws \App\Exceptions\Image\ImageStoreException
     */
    public function execute(UploadedFile $file, string $locationToMoveTo, string $coverPhotoName): string
    {
        $returnedImageName = $file->storeAs(
            $locationToMoveTo,
            $coverPhotoName,
            config('filesystems.default')
        );

        if ($returnedImageName === false) {
            throw new ImageStoreException();
        }

        return $returnedImageName;
    }
}
