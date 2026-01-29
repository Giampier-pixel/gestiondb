<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddPonenteRequest extends FormRequest
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
            'ponente'=>'required|exists:users,id',
            'ponencia'=>'required',
        ];
    }
    public function messages(): array
    {
        return [
            'ponente.required'=>'Debe seleccionar un ponente',
            'ponente.exists'=>'El ponente seleccionado no es válido',
            'ponencia.required'=>'El título de la ponencia es obligatorio',
        ];
    }
}
