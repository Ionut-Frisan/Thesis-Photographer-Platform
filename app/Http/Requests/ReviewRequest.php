<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rating' => ['required', 'integer'],
            'customer_id' => ['required', 'exists:users'],
            'photographer_id' => ['required', 'exists:users'],
            'title' => ['nullable'],
            'description' => ['nullable'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
