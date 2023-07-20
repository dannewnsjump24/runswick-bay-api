<?php

declare(strict_types=1);

namespace App\Http\Requests\Locations;

use App\Domain\Trips\Models\Trip;
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
                Rule::exists(Trip::class, 'id'), //@todo add custom validation rule to check the trip id is owned by logged in user.
            ],
            'lat' => [
                'required',
                'numeric',
            ],
            'long' => [
                'required',
                'numeric',
            ],
        ];
    }
}
