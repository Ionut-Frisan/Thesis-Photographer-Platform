<?php

namespace App\Http\Requests\Image;

use App\Models\Image;
use Illuminate\Foundation\Http\FormRequest;

class StoreImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Image::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'photoshoot_id' => 'required|exists:photoshoots,id',
        ];
    }

    public function messages(): array
    {
        return [
            'file.required' => 'Please select an image to upload.',
            'file.image' => 'The uploaded file must be an image.',
            'file.max' => 'The image size must not exceed 2MB.',
        ];
    }
}
