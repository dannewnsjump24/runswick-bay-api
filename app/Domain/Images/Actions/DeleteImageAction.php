<?php

declare(strict_types=1);

namespace App\Domain\Images\Actions;

use App\Exceptions\Image\DeleteImageException;
use Illuminate\Support\Facades\Storage;

class DeleteImageAction
{
    /**
     * @throws \App\Exceptions\Image\DeleteImageException
     */
    public function execute(string $file): bool
    {
        throw_if(Storage::missing($file), DeleteImageException::class);

        return Storage::delete($file);
    }
}
