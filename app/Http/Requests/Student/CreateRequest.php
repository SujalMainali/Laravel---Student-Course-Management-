<?php

namespace App\Http\Requests\Student;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('students', 'email')->ignore($this->route('student')),
            ],
            'dob' => ['required', 'date', 'before_or_equal:today'],
            'profile_image' => ['nullable', 'mimes:jpeg,jpg', 'max:2048'], // Optional profile image
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Name',
            'email' => 'Email',
            'dob' => 'Date of Birth',
            'profile_image' => 'Profile Image',
        ];
    }

    public function messages(): array
    {
        return [
            'profile_image.mimes' => 'Please upload a jpeg or jpg image.',
            'profile_image.max' => 'Keep the size of image under 2MB.',
        ];
    }
}
