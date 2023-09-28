<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Images;

use App\Domain\Images\Actions\DeleteImageAction;
use App\Domain\Images\Actions\StoreTripCoverPhotoAction;
use App\Exceptions\Image\DeleteImageException;
use App\Exceptions\Image\ImageStoreException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

#[Group("Images")]
class DeleteImageActionTest extends TestCase
{
    #[Test]
    public function it_deletes_file(): void
    {
        Storage::fake('local');

        $file = UploadedFile::fake()->create('hello.jpg');
        
        Storage::putFileAs('tester-location', $file, 'hello.jpg');

        $action = app()->make(DeleteImageAction::class);

        $success = $action->execute('tester-location/hello.jpg');

        Storage::assertMissing('tester-location/hello.jpg');

        $this->assertTrue($success);
    }

    #[Test]
    public function it_throws_an_exception_if_file_is_missing(): void
    {
        Storage::fake('local');

        $this->expectException(DeleteImageException::class);

        $action = app()->make(DeleteImageAction::class);

        $success = $action->execute('tester-location/hello.jpg');
    }
}
