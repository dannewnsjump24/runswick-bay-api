<?php

declare(strict_types=1);

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class RegisterUserRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'email' => $this->faker->email(),
            'name' => $this->faker->name(),
            'password' => 'password',
            'device_name' => $this->faker->word(),
        ];
    }
}
