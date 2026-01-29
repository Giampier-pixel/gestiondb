<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddCertificadoBaseRequest extends FormRequest
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
            'base' => 'required|file|image',
        ];
    }
    public function messages()
    {
        return [
            'base.required' => 'El archivo de certificado es obligatorio.',
            'base.file' => 'El certificado debe ser un archivo válido.',
            'base.image' => 'El certificado debe ser una imagen.',
        ];
    }
}
