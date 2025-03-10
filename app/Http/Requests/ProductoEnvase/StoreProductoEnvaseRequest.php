<?php

namespace App\Http\Requests\ProductoEnvase;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoEnvaseRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'producto_id' => 'required|exists:productos,id',
            'unidad_id' => 'required|exists:unidads,id',
            'cantidad' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'producto_id.required' => 'El ID del producto es obligatorio.',
            'producto_id.exists' => 'El producto seleccionado no existe.',
            'unidad_id.required' => 'El ID de la unidad es obligatorio.',
            'unidad_id.exists' => 'La unidad seleccionado no existe.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser mayor o igual a 1.',
        ];
    }

}
