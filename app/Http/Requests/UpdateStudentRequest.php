<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStudentRequest extends FormRequest
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
        $student = $this->route('student');
        return [
            'name' => 'sometimes|required|max:255|string',
            'email' => ['sometimes', 'required', 'email', Rule::unique('students', 'email')->ignore($student->id)],
            'phone' => 'sometimes|required|string|max:20',
            'date_of_birth' => 'sometimes|required|date|before:today',
            'gender' => 'sometimes|required|in:male,female,other',
            'address' => 'nullable|string',
            'profile_image' => 'sometimes|required|image|mimes:jpg,png,jpeg,webp|max:2048',
        ];
    }
}
