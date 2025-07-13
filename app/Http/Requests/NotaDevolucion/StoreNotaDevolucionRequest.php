<?php

namespace App\Http\Requests\NotaDevolucion;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotaDevolucionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cliente_id' => 'nullable|exists:clientes,id',
            'proveedor_id' => 'nullable|exists:proveedor,id',
            'user_id' => 'required|exists:users,id',
            'gestion_id' => 'required|exists:gestiones,id',
            'codigo_factura' => 'required|string|max:255|unique:nota_devolucion,codigo_factura',
            'fecha' => 'required|date|before_or_equal:today',
            'lugar' => 'nullable|string|max:255',
            'recibido' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'proveedor_id.exists' => 'El proveedor seleccionado no existe.',
            'user_id.required' => 'El ID del usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no existe.',
            'gestion_id.required' => 'El ID de la gestión es obligatorio.',
            'gestion_id.exists' => 'La gestión seleccionada no existe.',
            'codigo_factura.required' => 'El código de factura es obligatorio.',
            'codigo_factura.string' => 'El código de factura debe ser una cadena de texto.',
            'codigo_factura.max' => 'El código de factura no debe exceder los 255 caracteres.',
            'codigo_factura.unique' => 'El código de factura ya está en uso.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'fecha.before_or_equal' => 'La fecha no puede ser futura.',
            'lugar.string' => 'El lugar debe ser una cadena de texto.',
            'lugar.max' => 'El lugar no debe exceder los 255 caracteres.',
            'recibido.string' => 'El campo recibido debe ser una cadena de texto.',
            'recibido.max' => 'El campo recibido no debe exceder los 255 caracteres.'
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if (!$this->cliente_id && !$this->proveedor_id) {
                $validator->errors()->add('cliente_id', 'Debe seleccionar un cliente o un proveedor.');
                $validator->errors()->add('proveedor_id', 'Debe seleccionar un cliente o un proveedor.');
            }

            if ($this->cliente_id && $this->proveedor_id) {
                $validator->errors()->add('cliente_id', 'Solo puede seleccionar uno: cliente o proveedor.');
                $validator->errors()->add('proveedor_id', 'Solo puede seleccionar uno: cliente o proveedor.');
            }
        });
    }

}
