<?php

namespace App\Http\Requests\Review;

use App\Models\Review;
use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'customer_id' => ['required', 'exists:users'],
            'photographer_id' => ['required', 'exists:users'],
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can('create', Review::class);
    }
}
