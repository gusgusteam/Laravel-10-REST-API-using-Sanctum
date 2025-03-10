<?php

namespace App\Http\Requests\Gestion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGestionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $gestionId = $this->route('id'); 
        $rules = (new StoreGestionRequest())->rules(); 
        $rules['nombre_campania'] = [
            'required', 'string',
            Rule::unique('gestiones')->where(function ($query) {
                return $query->where('anio', $this->anio);
            })->ignore($gestionId) // Ignorar el ID actual
        ];

        return $rules;
    }

    public function messages(): array
    {
        return (new StoreGestionRequest())->messages();
    }
}

