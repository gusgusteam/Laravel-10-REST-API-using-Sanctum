<?php

namespace App\Http\Requests\DetalleDevolucion;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDetalleDevolucionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:detalle_devolucion,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'El ID del detalle de devolucion es obligatorio.',
            'id.exists' => 'El detalle de devolucion no existe.' 
        ];
    }

    public function withValidator($validator)
    {
        $detalleDevolucionId = $this->input('id'); // O el nombre del parámetro en tu ruta
        $detalleDevolucion = \App\Models\DetalleDevolucion::with('notaDevolucion')->find($detalleDevolucionId);
        if ($detalleDevolucion->notaDevolucion->nota_alterna == 1) {
            $validator->after(function ($validator) {
                $validator->errors()->add('id_detalle', 'No se puede eliminar el detalle: la nota de devolucion se encuentra anulada.');
            });
        }
    }
}
