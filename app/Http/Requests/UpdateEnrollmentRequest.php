<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\validation\Rule;

class UpdateEnrollmentRequest extends FormRequest
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
        $enrollment = $this->route('enrollment');
        $studentId = $this->input('student_id',$enrollment->student_id);
        return [
            'student_id' => 'sometimes|required|exists:students,id',
            'course_id' => ['sometimes', 'required', 'exists:courses,id', Rule::unique('enrollments', 'course_id')->where('student_id', $studentId)->ignore($enrollment->id),],
            'enrollment_date' => 'sometimes|required|date',
            'status' => 'sometimes|required|in:active,completed,cancelled',
        ];
    }
}
