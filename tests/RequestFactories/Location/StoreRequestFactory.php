<?php

namespace Tests\RequestFactories\Location;

use Worksome\RequestFactories\RequestFactory;

class StoreRequestFactory extends RequestFactory
{
    public function definition(): array
    {
        return [
          // 'email' => $this->faker->email,
        ];
    }
}
