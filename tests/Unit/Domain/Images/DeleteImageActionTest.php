<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Images;

use App\Domain\Images\Actions\DeleteImageAction;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
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

        $success = $action->execute('tester-location/hello.jpg', 'local');

        Storage::assertMissing('tester-location/hello.jpg');
    }
}
