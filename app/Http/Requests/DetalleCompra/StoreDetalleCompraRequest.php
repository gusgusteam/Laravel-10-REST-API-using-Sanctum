<?php

namespace App\Http\Requests\DetalleCompra;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetalleCompraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nota_compra_id' => 'required|exists:nota_compra,id',
            'producto_envase_id' => 'required|exists:producto_envase,id',
            'precio_asignado' => 'required|numeric|min:0',
            'cantidad' => 'required|numeric|min:0.01',
            'observacion' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nota_compra_id.required' => 'La nota de compra es obligatoria.',
            'nota_compra_id.exists' => 'La nota de compra seleccionada no es válida.',
            'producto_envase_id.required' => 'El producto envase es obligatorio.',
            'producto_envase_id.exists' => 'El producto envase seleccionado no es válido.',
            'precio_asignado.required' => 'El precio asignado es obligatorio.',
            'precio_asignado.numeric' => 'El precio asignado debe ser un número.',
            'precio_asignado.min' => 'El precio asignado debe ser mayor o igual a 0.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.numeric' => 'La cantidad debe ser un número.',
            'cantidad.min' => 'La cantidad debe ser mayor o igual a 0.01.',
            'observacion.string' => 'La observación debe ser una cadena de texto.',
        ];
    }
}
