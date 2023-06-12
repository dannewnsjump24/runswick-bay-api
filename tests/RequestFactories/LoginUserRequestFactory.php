<?php

namespace Tests\RequestFactories;

use Worksome\RequestFactories\RequestFactory;

class LoginUserRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
            'email' => $this->faker->email(),
            'password' => 'password',
            'device_name' => $this->faker->word(),
        ];
    }
}
