<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FileRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'storage_provider' => ['required'],
            'path' => ['required'],
            'name' => ['required'],
            'size' => ['required', 'integer'],
            'mime' => ['required'],
            'extension' => ['required'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
