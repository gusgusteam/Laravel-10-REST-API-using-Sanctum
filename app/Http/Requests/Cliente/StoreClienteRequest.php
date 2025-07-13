<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClienteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'paterno' => 'required|string|max:255',
            'materno' => 'required|string|max:255',
            'ci' => [
                 'required',
                 'string',
                 'max:15',
                 Rule::unique('clientes')
            ],
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'image' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser una cadena de texto.',
            'nombre.max' => 'El nombre no debe superar los 255 caracteres.',
    
            'paterno.required' => 'El apellido paterno es obligatorio.',
            'paterno.string' => 'El apellido paterno debe ser una cadena de texto.',
            'paterno.max' => 'El apellido paterno no debe superar los 255 caracteres.',
    
            'materno.required' => 'El apellido materno es obligatorio.',
            'materno.string' => 'El apellido materno debe ser una cadena de texto.',
            'materno.max' => 'El apellido materno no debe superar los 255 caracteres.',
    
            'ci.required' => 'El CI es obligatorio.',
            'ci.string' => 'El CI debe ser una cadena de texto.',
            'ci.max' => 'El CI no debe superar los 20 caracteres.',
            'ci.unique' => 'El CI ya está registrado.',
    
            'direccion.string' => 'La dirección debe ser una cadena de texto.',
            'direccion.max' => 'La dirección no debe superar los 255 caracteres.',
    
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no debe superar los 20 caracteres.',
            'image.string' => 'El campo de la imagen debe ser una cadena de texto b64.',
        ];
    }
}

