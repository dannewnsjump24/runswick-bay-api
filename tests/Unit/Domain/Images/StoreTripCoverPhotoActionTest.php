<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Images;

use App\Domain\Images\Actions\StoreTripCoverPhotoAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Images")]
class StoreTripCoverPhotoActionTest extends TestCase
{
    #[Test]
    public function it_does_upload_file_to_required_storage_location_with_correct_name(): void
    {
        Storage::fake('local');

        $uploadedFile = UploadedFile::fake()->image('hello.jpg');

        $action = app()->make(StoreTripCoverPhotoAction::class);

        $location = 'tester-location';

        $filename = '123.jpg';

        $expectedResult = $location . '/' . $filename;

        $result = $action->execute($uploadedFile, $location, $filename);

        $this->assertSame($expectedResult, $result);

        Storage::assertExists($expectedResult);
    }
}
