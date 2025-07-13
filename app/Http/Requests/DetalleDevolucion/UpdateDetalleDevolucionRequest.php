<?php

namespace App\Http\Requests\DetalleDevolucion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetalleDevolucionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'precio_asignado' => 'required|numeric|min:0',
            'cantidad' => 'required|numeric|min:0.01',
            'observacion' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return (new StoreDetalleDevolucionRequest())->messages();
    }

    public function withValidator($validator)
    {
        $detalleDevolucionId = $this->route('id'); // O el nombre del parámetro en tu ruta
        $detalleDevolucion = \App\Models\DetalleDevolucion::with('notaDevolucion')->find($detalleDevolucionId);
        if ($detalleDevolucion->notaVenta->nota_alterna == 1) {
            $validator->after(function ($validator) {
                $validator->errors()->add('nota_devolucion_id', 'No se puede actualizar el detalle: la nota de devolucion se encuentra anulada.');
            });
        }
    }
}
