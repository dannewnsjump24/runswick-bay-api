<?php

declare(strict_types=1);

namespace App\Domain\Trips\Collections;

use Illuminate\Database\Eloquent\Collection;

/**
 * @template TKey of array-key
 * @template TModel of \App\Domain\Trips\Models\Trip
 *
 * @extends \Illuminate\Database\Eloquent\Collection<int, TModel>
 */
class TripCollection extends Collection
{
}
