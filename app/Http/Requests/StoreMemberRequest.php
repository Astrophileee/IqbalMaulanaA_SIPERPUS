<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/^08[0-9]{8,11}$/', 'unique:members,phone'],
            'email' => ['required', 'string', 'max:255', 'unique:members,email'],
            'address' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Name member is required.',
            'name.string' => 'Name member must be a string.',
            'name.max' => 'Name member must not exceed 255 characters.',

            'phone.required' => 'Phone member is required.',
            'phone.string' => 'Phone member must be a string.',
            'phone.unique' => 'Phone member must be unique.',
            'phone.regex' => 'The phone number must start with 08 and be 10 to 13 digits long.',

            'email.required' => 'Email member is required.',
            'email.string' => 'Email member must be a string.',
            'email.max' => 'Email member must not exceed 255 characters.',
            'email.unique' => 'Email member must be unique.',

            'address.required' => 'Address member is required.',
            'address.string' => 'Address member must be a string.',
            'address.max' => 'Address member must not exceed 255 characters.',
        ];
    }
}
