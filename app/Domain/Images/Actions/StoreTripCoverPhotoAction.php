<?php

declare(strict_types=1);

namespace App\Domain\Images\Actions;

use Illuminate\Http\UploadedFile;

class StoreTripCoverPhotoAction
{
    public function execute(UploadedFile $file, string $locationToMoveTo, string $coverPhotoName): false|string
    {
        return $file->storeAs(
            $locationToMoveTo,
            $coverPhotoName,
            config('filesystems.default')
        );
    }
}
