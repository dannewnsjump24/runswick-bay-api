<?php

declare(strict_types=1);

namespace App\Http\Requests\Trips;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => 'required',
            'start_date' => [
                'required',
                'date',
            ],
            'end_date' => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
            'cover_photo' => [
                'nullable',
                'file',
                'mimes:jpg,png',
                'max:20000',
            ],
        ];
    }
}
