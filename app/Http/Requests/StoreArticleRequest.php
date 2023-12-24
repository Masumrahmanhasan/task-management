<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
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
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published_at' => ['nullable', 'date'],
            'user_id' => ['nullable'],
            'category_id' => ['required', 'array', 'min:1', 'exclude'],
            'category_id.*' => ['required', 'exists:categories,id', 'exclude'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'user_id' => auth()->id(),
            'published_at' => now(),
        ]);
    }
}
