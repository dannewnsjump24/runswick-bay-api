<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\LocationImage;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationImageFactory extends Factory
{
    protected $model = LocationImage::class;

    public function definition(): array
    {
        return [
            'path' => storage_path('/test/file.jpg'),
            'name' => 'file.jpg',
        ];
    }
}
