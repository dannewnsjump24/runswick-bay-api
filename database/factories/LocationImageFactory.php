<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Locations\Models\LocationImage;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\File;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Locations\Models\LocationImage>
 *
 * @mixin \App\Domain\Locations\Models\LocationImage
 */
class LocationImageFactory extends Factory
{
    protected $model = LocationImage::class;

    public function definition(): array
    {
        $filepath = storage_path('images');

        if (! File::exists($filepath)) {
            File::makeDirectory($filepath);
        }

        return [
            'path' => $this->faker->image(storage_path('images'), 1200),
            'name' => 'file.jpg',
        ];
    }
}
