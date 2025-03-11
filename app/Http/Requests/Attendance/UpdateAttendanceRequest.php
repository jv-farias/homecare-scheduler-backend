<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttendanceRequest extends FormRequest
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
            'name' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'address' => 'sometimes|string|max:500',
            'request_reason' => 'sometimes|string|in:general_consultation,fever_symptoms,trauma_injury,cardiac_emergency,respiratory_problem,other',
            'symptoms' => 'nullable|string|max:500',
            'status' => 'sometimes' | 'string' | 'in:pending,assigned,in_progress,completed,cancelled'
        ];
    }
}
