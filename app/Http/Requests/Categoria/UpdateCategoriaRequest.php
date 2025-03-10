<?php

namespace App\Http\Requests\Categoria;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoriaRequest extends FormRequest
{
    public function rules(): array
    {
        $CategoriaId = $this->route('id'); 
        $rules = (new StoreCategoriaRequest())->rules(); 
        $rules['nombre'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('categorias')->ignore($CategoriaId),
        ];

        return $rules;
    }

    public function messages()
    {
        return (new StoreCategoriaRequest())->messages();
    }

    public function authorize(): bool
    {
        return true;
    }
}

