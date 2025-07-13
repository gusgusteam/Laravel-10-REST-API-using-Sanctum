<?php

namespace App\Http\Requests\DetalleCompra;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetalleCompraRequest extends FormRequest
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
        return (new StoreDetalleCompraRequest())->messages();
    }

    public function withValidator($validator)
    {
        $detalleCompraId = $this->route('id'); // O el nombre del parámetro en tu ruta
        $detalleCompra= \App\Models\DetalleCompra::with('notaCompra')->find($detalleCompraId);
        if ($detalleCompra->notaCompra->nota_alterna == 1) {
            $validator->after(function ($validator) {
                $validator->errors()->add('nota_compra_id', 'No se puede actualizar el detalle: la nota de compra se encuentra anulada.');
            });
        }
    }
}
