<?php

namespace App\Http\Requests\Configuracion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConfiguracionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre_empresa' => 'required|string|max:255',
            'telefono' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'nit' => 'required|string|max:255',
            'razon_social' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'frase' => 'nullable|string|max:255',
            'id_gestion' => 'required|integer|exists:gestiones,id'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre_empresa.required' => 'El nombre de la empresa es obligatorio.',
            'nombre_empresa.string' => 'El nombre de la empresa debe ser una cadena de texto.',
            'nombre_empresa.max' => 'El nombre de la empresa no debe superar los 255 caracteres.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no debe superar los 255 caracteres.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.string' => 'La dirección debe ser una cadena de texto.',
            'direccion.max' => 'La dirección no debe superar los 255 caracteres.',

            'email.required' => 'El email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.max' => 'El email no debe superar los 255 caracteres.',

            'nit.required' => 'El NIT es obligatorio.',
            'nit.string' => 'El NIT debe ser una cadena de texto.',
            'nit.max' => 'El NIT no debe superar los 255 caracteres.',

            'razon_social.required' => 'La razón social es obligatoria.',
            'razon_social.string' => 'La razón social debe ser una cadena de texto.',
            'razon_social.max' => 'La razón social no debe superar los 255 caracteres.',

            'frase.string' => 'La frase debe ser una cadena de texto.',
            'frase.max' => 'La frase no debe superar los 255 caracteres.',

            'id_gestion.required' => 'La gestión es obligatoria.',
            'id_gestion.integer' => 'La gestión debe ser un número entero.',
        ];
    }
}
