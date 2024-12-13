<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255', 'unique:books,title'],
            'author' => ['required', 'string', 'max:255'],
            'year' => ['required', 'numeric', 'gt:1944','lt:2025'],
            'publisher' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'cover' => ['required', 'image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            'bookshelf_id' => ['required', 'integer'],
            'categories' => ['required'],
            'categories.*' => ['integer','nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.string' => 'Title must be a string.',
            'title.max' => 'Title must not exceed 255 characters.',
            'title.unique' => 'Title must be unique.',

            'author.required' => 'Author is required.',
            'author.string' => 'Author must be a string.',
            'author.max' => 'Author must not exceed 255 characters.',

            'year.required' => 'Year is required.',
            'year.numeric' => 'Year must be a number.',
            'year.gt' => 'Year must be greater than 2000.',
            'year.lt' => 'Year must be less than 2024.',

            'publisher.required' => 'Publisher is required.',
            'publisher.string' => 'Publisher must be a string.',
            'publisher.max' => 'Publisher must not exceed 255 characters.',

            'city.required' => 'City is required.',
            'city.string' => 'City must be a string.',
            'city.max' => 'City must not exceed 255 characters.',

            'cover.required' => 'Cover image is required.',
            'cover.string' => 'Cover must be a valid file path.',
            'cover.max' => 'Cover file path must not exceed 255 characters.',

            'bookshelf_id.required' => 'Bookshelf is required.',
            'bookshelf_id.string' => 'Bookshelf must be a valid string.',
            'bookshelf_id.max' => 'Bookshelf name must not exceed 255 characters.',

            'categories.required' => 'At least one category is required.',
            'categories.array' => 'Categories must be an array.',
            'categories.*.integer' => 'Each category must be a valid integer.',
            'categories.*.exists' => 'Each category must exist in the database.',
        ];
    }
}
