<?php

namespace App\Http\Requests\DetalleCompra;

use Illuminate\Foundation\Http\FormRequest;

class DeleteDetalleCompraRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'id' => 'required|exists:detalle_compra,id',
        ];
    }

    public function messages(): array
    {
        return [
            'id.required' => 'El ID del detalle de compra es obligatorio.',
            'id.exists' => 'El detalle de compra no existe.' 
        ];
    }

    public function withValidator($validator)
    {
        $detalleCompraId = $this->input('id'); // O el nombre del parámetro en tu ruta
        $detalleCompra = \App\Models\DetalleCompra::with('notaCompra')->find($detalleCompraId);
        if ($detalleCompra->notaCompra->nota_alterna == 1) {
            $validator->after(function ($validator) {
                $validator->errors()->add('id_detalle', 'No se puede eliminar el detalle: la nota de compra se encuentra anulada.');
            });
        }
    }
}
