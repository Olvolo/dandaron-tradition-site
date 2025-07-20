<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreChapterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content_html' => 'required|string',
            'order_column' => 'nullable|integer',
            'parent_id' => 'nullable|exists:chapters,id',
        ];
    }
}
