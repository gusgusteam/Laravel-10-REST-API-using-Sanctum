<?php

namespace App\Http\Requests\DetalleVenta;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDetalleVentaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:detalle_ventas,id',
            //'producto_envase_id' => 'required|exists:producto_envase,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'El ID del detalle de venta es obligatorio.',
            'id.exists' => 'El detalle de venta no existe.' 
        ];
    }

    public function withValidator($validator)
    {
        $detalleVentaId = $this->input('id'); // O el nombre del parámetro en tu ruta
        $detalleVenta = \App\Models\DetalleVenta::with('notaVenta')->find($detalleVentaId);
        if ($detalleVenta->notaVenta->nota_alterna == 1) {
            $validator->after(function ($validator) {
                $validator->errors()->add('id_detalle', 'No se puede eliminar el detalle: la nota de venta se encuentra anulada.');
            });
        }
    }
}
