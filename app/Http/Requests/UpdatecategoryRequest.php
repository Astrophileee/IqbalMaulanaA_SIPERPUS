<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatecategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $categoryId = $this->route('category')->id;
        return [
            'category' => ['required', 'string', 'max:255', 'unique:categories,category,' . $categoryId],
        ];
    }
    public function messages(): array
    {
        return [
            'category.required' => 'Category name is required.',
            'category.string' => 'Category name must be a string.',
            'category.max' => 'Category name must not exceed 255 characters.',
            'category.unique' => 'Category name must be unique.',
        ];
    }
}
