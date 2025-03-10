<?php

namespace App\Http\Requests\Permission;

use Illuminate\Foundation\Http\FormRequest;

class StorePermissionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|unique:permissions,name|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del permiso es obligatorio.',
            'name.unique' => 'El nombre del permiso ya existe.',
            'name.max' => 'El nombre del permiso no puede superar los 255 caracteres.',
        ];
    }
}

