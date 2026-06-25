<?php

namespace App\Http\Requests\Course;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

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
            'credits' => ['required', 'integer', 'min:1', 'max:30'],
            'documents' => ['nullable', 'array'],
            'documents.*' => ['file', 'mimes:pdf,doc,docx,jpg,jpeg', 'max:2048'],
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'course name',
            'credits' => 'course credits',
            'documents' => 'course documents',
            'documents.*' => 'document file',
        ];
    }

    public function messages(): array
    {
        return [
            'documents.*.mimes' => 'Please!! Only Upload One of pdf, doc, docx, jpg, jpeg.',
            'documents.*.max' => 'Keep the document file size under 2MB.'
        ];
    }
}
