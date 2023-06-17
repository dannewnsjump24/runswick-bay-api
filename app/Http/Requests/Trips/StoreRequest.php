<?php

declare(strict_types=1);

namespace App\Http\Requests\Trips;

use App\Models\User;
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
                'size:20000',
            ],
        ];
    }

    /**
     * @todo Think about how we can better handle this even though we're using sanctum so that is added to all routes
     */
    public function authorize(): bool
    {
        $user = $this->user();

        if (!$user instanceof User) {
            return false;
        }

        return true;
    }
}
