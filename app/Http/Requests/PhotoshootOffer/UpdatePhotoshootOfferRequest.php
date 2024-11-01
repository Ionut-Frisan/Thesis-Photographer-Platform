<?php

namespace App\Http\Requests\PhotoshootOffer;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePhotoshootOfferRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'description' => ['required'],
            'duration' => ['required', 'integer'],
            'price' => ['required', 'numeric'],
            'max_image_count' => ['nullable', 'integer'],
            'avg_turnaround_time' => ['nullable', 'integer'],
            'photographer_id' => ['required', 'exists:users,id'],
//            'delivery_method' => ['required'],
//            'cancellation_policy' => ['required'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
