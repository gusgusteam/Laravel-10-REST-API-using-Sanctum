<?php

namespace App\Http\Requests\DetalleVenta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetalleVentaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            //'nota_venta_id' => 'required|exists:nota_ventas,id',
            //'producto_envase_id' => 'required|exists:producto_envase,id',
            'precio_asignado' => 'required|numeric|min:0',
            'cantidad' => 'required|numeric|min:0.01',
            //'subtotal' => 'required|numeric|min:0',
            'dosis_recomendada' => 'nullable|string',
            //'dosis_comercial' => 'nullable|string',
            'observacion' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return (new StoreDetalleVentaRequest())->messages();
    }

    public function withValidator($validator)
    {
        $detalleVentaId = $this->route('id'); // O el nombre del parámetro en tu ruta
        $detalleVenta = \App\Models\DetalleVenta::with('notaVenta')->find($detalleVentaId);
        if ($detalleVenta->notaVenta->nota_alterna == 1) {
            $validator->after(function ($validator) {
                $validator->errors()->add('nota_venta_id', 'No se puede actualizar el detalle: la nota de venta se encuentra anulada.');
            });
        }
    }
}
