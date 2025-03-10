<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RemoveRoleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'role' => 'required|string|exists:roles,name',
        ];
    }

    public function messages()
    {
        return [
            'role.required' => 'El rol es obligatorio.',
            'role.string' => 'El rol debe ser una cadena de texto.',
            'role.exists' => 'El rol seleccionado no existe.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}

