<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class StoreProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'razon_social' => 'required|string|max:255',
            'correo' => 'required|string|max:255',
            'direccion' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:15',
            'image' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'razon_social.required' => 'El campo Razón Social es obligatorio.',
            'razon_social.string' => 'El campo Razón Social debe ser una cadena de texto.',
            'razon_social.max' => 'El campo Razón Social no puede tener más de 255 caracteres.',
            'correo.required' => 'El campo Correo es obligatorio.',
            'correo.string' => 'El campo Correo debe ser una cadena de texto.',
            'correo.max' => 'El campo Correo no puede tener más de 255 caracteres.',
            'direccion.string' => 'El campo Dirección debe ser una cadena de texto.',
            'direccion.max' => 'El campo Dirección no puede tener más de 255 caracteres.',
            'telefono.string' => 'El campo Teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El campo Teléfono no puede tener más de 15 caracteres.',
            'image.string' => 'La imagen debe ser una cadena de texto válida en base64.',
        ];
    }
}
