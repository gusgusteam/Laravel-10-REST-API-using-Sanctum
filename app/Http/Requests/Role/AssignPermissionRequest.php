<?php

namespace App\Http\Requests\Role;

use Illuminate\Foundation\Http\FormRequest;

class AssignPermissionRequest extends FormRequest
{
    public function rules(): array
    {
        //$id = $this->route('id_rol'); 
        return [
            'permission' => 'required|string|exists:permissions,name',
           // 'rol' => 'required|exists:roles,id',
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

