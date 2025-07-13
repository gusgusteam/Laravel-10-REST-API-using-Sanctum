<?php

namespace App\Http\Requests\TipoProducto;

use App\Models\TipoProducto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTipoProductoRequest extends FormRequest
{
    public function rules(): array
    {
        $tipoId = $this->route('id'); 
        $rules = (new StoreTipoProductoRequest())->rules(); 
        $rules['nombre'] = [
            'required',
            'string',
            'max:255',
            Rule::unique('tipo_productos')->ignore($tipoId),
        ];

        return $rules;
    }

    public function messages(): array
    {
        return (new StoreTipoProductoRequest())->messages();
    }

    public function authorize(): bool
    {
        return true;
    }

    public function withValidator($validator)
    {
        $TipoProductoId = $this->route('id');
        $TipoProducto = TipoProducto::find($TipoProductoId);

        if ($TipoProducto && $TipoProducto->estado == 0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('estado', 'No se puede actualizar un tipo producto inactivo.');
            });
        }
    }
}

