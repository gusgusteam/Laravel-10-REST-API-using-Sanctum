<?php

namespace App\Http\Requests\Unidad;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUnidadRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('unidads')
            ],
            'nombre_corto' => [
                'required',
                'string',
                'max:255'
            ],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres.',
            'nombre.unique' => 'La unidad ya ha sido registrado.',
            'nombre_corto.required' => 'El nombre corto es obligatorio.',
            'nombre_corto.string' => 'El nombre corto debe ser una cadena de texto.',
            'nombre_corto.max' => 'El nombre corto no puede tener más de 255 caracteres.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

