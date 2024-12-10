<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookshelfRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'code' => ['required', 'string', 'max:10', 'unique:bookshelves,code'],
            'name' => ['required', 'string', 'max:255', 'unique:bookshelves,name']
        ];
    }

    public function messages(): array
    {
        return [
            'code.required' => 'Code is required.',
            'code.string' => 'Code must be a string.',
            'code.max' => 'Code must not exceed 10 characters.',
            'code.unique' => 'Code must be unique.',
            
            'name.required' => 'Name is required.',
            'name.string' => 'Name must be a string.',
            'name.max' => 'Name must not exceed 255 characters.',
            'name.unique' => 'Name must be unique.',
        ];
    }
}
