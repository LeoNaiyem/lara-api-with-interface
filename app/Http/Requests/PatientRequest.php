<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PatientRequest extends FormRequest
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
            'name' => 'required|string|max:225',
            'mobile' => 'required|string|max:225',
            'dob' => 'required|date|before:today',
            'mob_ext' => 'required|integer',
            'gender' => 'required|integer',
            'profession' => 'nullable|string|max:255',
        ];
    }
}
