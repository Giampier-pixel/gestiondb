<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El campo email debe ser un email válido',
            'email.exists' => 'El email no está registrado en el sistema',
            'password.required' => 'El campo contraseña es obligatorio',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres'
        ];
    }
}