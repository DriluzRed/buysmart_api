<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
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
            'email' => 'required|email',
            'password' => 'required|min:6',
            'name' => 'required|string',
            'ci' => 'required|unique:users,ci|numeric',
            'phone' => 'required|unique:users,phone|numeric',
            'birthdate' => 'required|date',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es válido',
            'password.required' => 'La contraseña es requerida',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres',
            'name.required' => 'El nombre es requerido',
            'ci.required' => 'La cédula es requerida',
            'ci.unique' => 'La cédula ya está registrada',
            'ci.numeric' => 'La cédula debe ser numérica',
            'phone.required' => 'El teléfono es requerido',
            'phone.unique' => 'El teléfono ya está registrado',
            'phone.numeric' => 'El teléfono debe ser numérico',
            'birthdate.required' => 'La fecha de nacimiento es requerida',
            'birthdate.date' => 'La fecha de nacimiento no es válida',
        ];
    }
}
