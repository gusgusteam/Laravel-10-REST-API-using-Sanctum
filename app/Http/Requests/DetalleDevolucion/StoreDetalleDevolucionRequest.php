<?php

namespace App\Http\Requests\DetalleDevolucion;

use Illuminate\Foundation\Http\FormRequest;

class StoreDetalleDevolucionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nota_devolucion_id' => 'required|exists:nota_devolucion,id',
            'producto_envase_id' => 'required|exists:producto_envase,id',
            'precio_asignado' => 'required|numeric|min:0',
            'cantidad' => 'required|numeric|min:0.01',
            'observacion' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'nota_devolucion_id.required' => 'El ID de la nota de devolución es obligatorio.',
            'nota_devolucion_id.exists' => 'La nota de devolución seleccionada no existe.',
            'producto_envase_id.required' => 'El ID del producto/envase es obligatorio.',
            'producto_envase_id.exists' => 'El producto/envase seleccionado no existe.',
            'precio_asignado.required' => 'El precio asignado es obligatorio.',
            'precio_asignado.numeric' => 'El precio asignado debe ser un número.',
            'precio_asignado.min' => 'El precio asignado debe ser al menos 0.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.numeric' => 'La cantidad debe ser un número.',
            'cantidad.min' => 'La cantidad debe ser al menos 0.01.',
            'observacion.string' => 'La observación debe ser una cadena de texto.',
        ];
    }

    public function withValidator($validator)
    {
        $notaDevolucionId = $this->input('nota_devolucion_id');
        $notaDevolucion = \App\Models\NotaDevolucion::find($notaDevolucionId);
        if ($notaDevolucion && $notaDevolucion->nota_alterna == 1) {
            $validator->after(function ($validator) {
                $validator->errors()->add('nota_devolucion_id', 'No se puede registrar detalle: la nota de devolucion se encuentra anulada.');
            });
        }
    }
}
