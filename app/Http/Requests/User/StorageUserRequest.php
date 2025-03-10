<?php

namespace App\Http\Requests\User;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorageUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return  auth()->check();
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'ci' => 'required|integer|min:0|unique:users',
            'paterno' => 'required|string|max:100',
            'materno' => 'required|string|max:100',
            'direccion' => 'required|string|max:500',
            'fechaNacimiento' => 'required|date',
            'edad' => 'required|integer|min:0',
            'telefono' => 'required|integer|min:0'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',

            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Debe proporcionar un formato de correo electrónico válido.',
            'email.unique' => 'El correo electrónico ya ha sido registrado.',
    
            'ci.required' => 'El número de CI es obligatorio.',
            'ci.integer' => 'El número de CI debe ser un valor numérico.',
            'ci.min' => 'El número de CI no puede ser negativo.',
            'ci.unique' => 'El número de CI ya ha sido registrado.',
    
            'paterno.required' => 'El apellido paterno es obligatorio.',
            'paterno.string' => 'El apellido paterno debe ser una cadena de texto.',
            'paterno.max' => 'El apellido paterno no puede tener más de 100 caracteres.',
    
            'materno.required' => 'El apellido materno es obligatorio.',
            'materno.string' => 'El apellido materno debe ser una cadena de texto.',
            'materno.max' => 'El apellido materno no puede tener más de 100 caracteres.',
    
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.string' => 'La dirección debe ser una cadena de texto.',
            'direccion.max' => 'La dirección no puede tener más de 500 caracteres.',
    
            'fechaNacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fechaNacimiento.date' => 'Debe proporcionar una fecha válida.',
    
            'edad.required' => 'La edad es obligatoria.',
            'edad.integer' => 'La edad debe ser un valor numérico.',
            'edad.min' => 'La edad no puede ser negativa.',

            'telefono.required' => 'El nro telefono es obligatoria.',
            'telefono.integer' => 'El nro telefono debe ser un valor numérico.',
            'telefono.min' => 'El nro telefono no puede ser negativa.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Validación fallida',
            'data' => $validator->errors()
        ], 201);
    
        throw new HttpResponseException( $response);
    }

   
}
