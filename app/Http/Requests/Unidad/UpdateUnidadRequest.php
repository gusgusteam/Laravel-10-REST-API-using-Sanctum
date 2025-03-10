<?php

namespace App\Http\Requests\Unidad;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUnidadRequest extends FormRequest
{
    public function rules(): array
    {
        $unidadId = $this->route('id'); 
        $rules = (new StoreUnidadRequest())->rules(); 
        $rules['nombre'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('unidads')->ignore($unidadId),
        ];

        return $rules;
    }

    public function messages()
    {
        return (new StoreUnidadRequest())->messages();
    }

    public function authorize(): bool
    {
        return true;
    }
}

