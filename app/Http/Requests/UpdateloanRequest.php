<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateloanRequest extends FormRequest
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
            'member_id' => ['required'],
            'date' => ['required','date','before:return_at'],
            'return_at' => ['required','date','after:date'],
            'books' => ['required'],
            'books.*' => ['integer','nullable'],
        ];
    }
    public function messages(): array
    {
        return [
            'member_id.required' => 'Member is required.',

            'date.required' => 'Loan date is required.',
            'date.before' => 'The loan date must be before the return date.',

            'return_at.required' => 'Return date is required.',
            'return_at.after' => 'The return date must be after the loan date.',
        ];
    }
}
