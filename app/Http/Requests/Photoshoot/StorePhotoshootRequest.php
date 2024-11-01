<?php

namespace App\Http\Requests\Photoshoot;

use App\Http\Requests\Photoshoot;
use Illuminate\Foundation\Http\FormRequest;

class StorePhotoshootRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('create', Photoshoot::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:users,id',
            'photographer_id' => 'required|exists:users,id',
            'description' => 'required|string',
            'location' => 'required|string',
            'start_time' => 'required|date_format:Y-m-d H:i:s',
            'end_time' => 'required|date_format:Y-m-d H:i:s|after:start_time',
        ];
    }
}
