<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => 'nullable|string',
            'custom_styles' => 'nullable|string', // <-- Наше новое поле
            'order_column' => 'nullable|integer',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
        ];
    }
}
