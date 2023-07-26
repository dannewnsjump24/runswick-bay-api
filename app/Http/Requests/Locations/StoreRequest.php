<?php

declare(strict_types=1);

namespace App\Http\Requests\Locations;

use App\Domain\Locations\Dtos\Location;
use App\Domain\Trips\Models\Trip;
use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
            ],
            'trip_id' => [
                'required',
                Rule::exists(Trip::class, 'id')->where(function (Builder $query) {
                    /** @var \App\Models\User $user */
                    $user = $this->user();
                    return $query->where('owner_id', '=', $user->id);
                }),
            ],
            'latitude' => [
                'required',
                'numeric',
            ],
            'longitude' => [
                'required',
                'numeric',
            ],
        ];
    }

    public function toDto(): Location
    {
        return new Location(
            $this->string('trip_id')->toString(),
            $this->string('name')->toString(),
            $this->float('latitude'),
            $this->float('longitude')
        );
    }
}
