<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Domain\Trips\Models\Trip;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Domain\Trips\Models\Trip>
 * @mixin \App\Domain\Trips\Models\Trip
 */
class TripFactory extends Factory
{
    protected $model = Trip::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'owner_id' => User::factory(),
            'start_date' => Carbon::now(),
            'end_date' => Carbon::now(),
            'cover_photo' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }

    public function deleted(): static
    {
        return $this->state(fn (array $attributes) => [
            'deleted_at' => now(),
        ]);
    }
}
