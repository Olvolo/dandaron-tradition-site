<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Мы уже проверяем права админа через middleware, так что здесь просто разрешаем
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
                Rule::unique('articles', 'title')->ignore($this->route('article')),
            ],
            'category_id' => 'required|exists:categories,id',
            'content_html' => 'nullable|string',            'custom_styles' => 'nullable|string',
            'order_column' => 'nullable|integer',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ];
    }
}
