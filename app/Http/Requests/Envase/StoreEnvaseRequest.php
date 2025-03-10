<?php

namespace App\Http\Requests\Envase;

use Illuminate\Foundation\Http\FormRequest;

class StoreEnvaseRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'cantidad' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser al menos 1.',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}


