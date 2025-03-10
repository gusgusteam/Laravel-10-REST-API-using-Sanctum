<?php

namespace App\Http\Requests\NotaVenta;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotaVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id' => 'required|exists:clientes,id',
            'user_id' => 'required|exists:users,id',
            'gestion_id' => 'required|exists:gestiones,id',
            'cultivo_id' => 'required|exists:cultivos,id',
            'codigo_factura' => 'required|string|max:255|unique:nota_ventas,codigo_factura',
            'fecha' => 'required|date|before_or_equal:today',
            //'monto_total' => 'numeric|min:0',
            'lugar' => 'nullable|string|max:255',
            'recibido' => 'nullable|string|max:255',
            //'venta_credito' => 'boolean',
            //'estado' => 'boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.exists' => 'El cliente seleccionado no es válido.',
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no es válido.',
            'gestion_id.required' => 'La gestión es obligatoria.',
            'gestion_id.exists' => 'La gestión seleccionada no es válida.',
            'cultivo_id.required' => 'El cultivo es obligatorio.',
            'cultivo_id.exists' => 'El cultivo seleccionado no es válido.',
            'codigo_factura.required' => 'El código de factura es obligatorio.',
            'codigo_factura.unique' => 'El código de factura ya existe.',
            'fecha.required' => 'La fecha de la venta es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'fecha.before_or_equal' => 'La fecha no puede ser futura.',
            'monto_total.numeric' => 'El monto total debe ser un número.',
            'monto_total.min' => 'El monto total debe ser mayor o igual a 0.',
            'lugar.string' => 'El lugar debe ser una cadena de texto.',
            'recibido.string' => 'El recibido debe ser una cadena de texto.',
            'venta_credito.boolean' => 'El valor de venta a crédito debe ser 0 o 1.',
            'estado.boolean' => 'El estado debe ser 0 o 1.',
        ];
    }

}
