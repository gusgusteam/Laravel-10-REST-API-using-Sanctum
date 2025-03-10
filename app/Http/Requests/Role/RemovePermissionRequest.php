<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class RemovePermissionRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'permission' => 'required|string|exists:permissions,name',
        ];
    }

    public function messages()
    {
        return [
            'permission.required' => 'El permiso es obligatorio.',
            'permission.string' => 'El permiso debe ser una cadena de texto.',
            'permission.exists' => 'El permiso seleccionado no existe.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}


