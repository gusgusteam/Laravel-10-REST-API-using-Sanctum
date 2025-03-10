<?php

namespace App\Http\Requests\Cultivo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCultivoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('cultivos')
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del cultivo es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede exceder los 255 caracteres.',
            'nombre.unique' => 'El cultivo ya ha sido registrado.',
        ];
    }
}

