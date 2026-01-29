<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddEventoRequest extends FormRequest
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
            'name'=>'required',
            'fecha'=>'required|date',
            'url'=>'url',

        ];
    }
    public function messages(): array
    {
        return [
            'name.required'=>'El nombre del evento es obligatorio',
            'fecha.required'=>'La fecha del evento es obligatoria',
            'fecha.date'=>'La fecha no tiene el formato correcto',
            'url.url'=>'La URL no tiene el formato correcto',
        ];
    }
}
