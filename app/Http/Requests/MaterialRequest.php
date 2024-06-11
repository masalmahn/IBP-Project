<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaterialRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'name' => 'required|string|max:255',
            'student_no' => 'required|numeric',
            'akts' => 'required|numeric',
            'kredi' => 'required|numeric',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'The name field is required.',
            'name.string' => 'The name must be a string.',
            'name.max' => 'The name may not be greater than :max characters.',
            'student_no.required' => 'The student number field is required.',
            'student_no.numeric' => 'The student number must be a number.',
            'akts.required' => 'The AKTS field is required.',
            'akts.numeric' => 'The AKTS must be a number.',
            'kredi.required' => 'The credit field is required.',
            'kredi.numeric' => 'The credit must be a number.',
        ];
    }
}
