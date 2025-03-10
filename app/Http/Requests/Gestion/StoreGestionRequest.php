<?php

namespace App\Http\Requests\Gestion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreGestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    public function rules(): array
    {
        return [
            'anio' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'nombre_campania' => [
                'required', 'string',
                Rule::unique('gestiones')->where(function ($query) {
                    return $query->where('anio', $this->anio);
                })
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'anio.required' => 'El año es obligatorio.',
            'anio.integer' => 'El año debe ser un número entero.',
            'anio.min' => 'El año no puede ser menor a 2000.',
            'anio.max' => 'El año no puede ser mayor al año siguiente.',
            'nombre_campania.required' => 'El nombre de la campaña es obligatorio.',
            'nombre_campania.string' => 'El nombre de la campaña debe ser una cadena de texto.',
            'nombre_campania.max' => 'El nombre de la campaña no puede exceder los 255 caracteres.',
            'nombre_campania.unique' => 'Ya existe una gestión con este año y nombre de campaña.',
        ];
    }
}

