<?php

namespace App\Http\Requests\Unidad;

use App\Models\Unidad;
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

    public function withValidator($validator)
    {
        $CategoriaId = $this->route('id');
        $categoria = Unidad::find($CategoriaId);

        if ($categoria && $categoria->estado == 0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('estado', 'No se puede actualizar una unidad inactiva.');
            });
        }
    }
}

