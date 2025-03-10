<?php

namespace App\Http\Requests\Cultivo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCultivoRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $cultivoId = $this->route('id'); 
        $rules = (new StoreCultivoRequest())->rules(); 
        $rules['nombre'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('cultivos')->ignore($cultivoId),
        ];

        return $rules;
    }

    public function messages()
    {
        return (new StoreCultivoRequest())->messages();
    }
}
