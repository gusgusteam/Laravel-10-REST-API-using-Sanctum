<?php

namespace App\Http\Requests\DetalleVenta;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetalleVentaRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'nota_venta_id' => 'required|exists:nota_ventas,id',
            'producto_envase_id' => 'required|exists:producto_envase,id',
            'precio_asignado' => 'required|numeric|min:0',
            'cantidad' => 'required|numeric|min:0.01',
            //'subtotal' => 'required|numeric|min:0',
            'dosis_recomendada' => 'nullable|string',
            'dosis_comercial' => 'nullable|string',
            'observacion' => 'nullable|string',
        ];
    }
     
    public function messages(): array
    {
        return [
            'nota_venta_id.required' => 'La nota de venta es obligatoria.',
            'nota_venta_id.exists' => 'La nota de venta seleccionada no es válida.',
            'producto_envase_id.required' => 'El producto envase es obligatorio.',
            'producto_envase_id.exists' => 'El producto envase seleccionado no es válido.',
            'precio_asignado.required' => 'El precio asignado es obligatorio.',
            'precio_asignado.numeric' => 'El precio asignado debe ser un número.',
            'precio_asignado.min' => 'El precio asignado debe ser mayor o igual a 0.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.numeric' => 'La cantidad debe ser un número.',
            'cantidad.min' => 'La cantidad debe ser mayor o igual a 0.01.',
            'subtotal.required' => 'El subtotal es obligatorio.',
            'subtotal.numeric' => 'El subtotal debe ser un número.',
            'subtotal.min' => 'El subtotal debe ser mayor o igual a 0.',
            'dosis_recomendada.string' => 'La dosis recomendada debe ser una cadena de texto.',
            'dosis_comercial.string' => 'La dosis comercial debe ser una cadena de texto.',
            'observacion.string' => 'La observación debe ser una cadena de texto.',
        ];
    }

    public function withValidator($validator)
    {
        $notaVentaId = $this->input('nota_venta_id');
        $notaVenta = \App\Models\NotaVenta::find($notaVentaId);
        if ($notaVenta && $notaVenta->nota_alterna == 1) {
            $validator->after(function ($validator) {
                $validator->errors()->add('nota_venta_id', 'No se puede registrar detalle: la nota de venta se encuentra anulada.');
            });
        }
    }
}

