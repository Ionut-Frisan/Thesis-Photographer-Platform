<?php

namespace App\Http\Requests\Spot;

use App\Models\Spot;
use Illuminate\Foundation\Http\FormRequest;

class StoreSpotRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'location_id' => ['required', 'exists:locations'],
            'cover_image_id' => ['nullable', 'exists:files'],
            'owner_id' => ['nullable', 'exists:users'],
            'standard' => ['boolean'],
            'title' => ['required', 'string'],
            'description' => ['required', 'string'],
            'address' => ['required', 'string'],
            'accessibility' => ['nullable', 'string'],
            'opening_hours' => ['nullable', 'numeric'],
            'closing_hours' => ['nullable', 'numeric'],
        ];
    }

    public function authorize(): bool
    {
        return $this->user()->can('create', Spot::class);
    }
}
