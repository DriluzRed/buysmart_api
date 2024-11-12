<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAddressRequest extends FormRequest
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
            'address_line_1' => ['required', 'string', 'max:255'],
            'address_line_2' => ['nullable', 'string', 'max:255'],
            'department_id' => ['required', 'integer', 'exists:departments,id'],
            'city_id' => ['required', 'integer', 'exists:cities,id'],
            'neighborhood_id' => ['nullable'],
            'type' => ['required', 'string', 'in:home,work,other'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */

    public function messages(): array
    {
        return [
            'address_line_1.required' => 'The address line 1 field is required.',
            'address_line_1.string' => 'The address line 1 field must be a string.',
            'address_line_1.max' => 'The address line 1 field must not exceed 255 characters.',
            'address_line_2.string' => 'The address line 2 field must be a string.',
            'address_line_2.max' => 'The address line 2 field must not exceed 255 characters.',
            'department_id.required' => 'The department field is required.',
            'department_id.integer' => 'The department field must be an integer.',
            'department_id.exists' => 'The selected department is invalid.',
            'city_id.required' => 'The city field is required.',
            'city_id.integer' => 'The city field must be an integer.',
            'city_id.exists' => 'The selected city is invalid.',
            'neighborhood_id.exists' => 'The selected neighborhood is invalid.',
            'type.required' => 'The type field is required.',
            'type.string' => 'The type field must be a string.',
            'type.in' => 'The selected type is invalid.',
        ];
    }
}
