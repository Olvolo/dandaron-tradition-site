<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAuthorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Правило unique будет игнорировать текущего автора при обновлении
                Rule::unique('authors', 'name')->ignore($this->route('author')),
            ],
            'image_path' => 'nullable|string|max:255',
            'order_column' => 'nullable|integer',
        ];
    }
}
