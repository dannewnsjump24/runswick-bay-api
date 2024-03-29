<?php

declare(strict_types=1);

namespace App\Domain\Images\Actions;

use Illuminate\Support\Facades\Storage;

class DeleteImageAction
{
    public function execute(string $file, string $disk): void
    {
        if (Storage::disk($disk)->missing($file)) {
            return;
        }

        Storage::disk($disk)->delete($file);
    }
}
