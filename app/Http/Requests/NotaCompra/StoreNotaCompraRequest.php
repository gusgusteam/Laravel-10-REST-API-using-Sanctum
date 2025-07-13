<?php

namespace App\Http\Requests\NotaCompra;

use Illuminate\Foundation\Http\FormRequest;

class StoreNotaCompraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'user_id' => 'required|exists:users,id',
            'gestion_id' => 'required|exists:gestiones,id',
            'proveedor_id' => 'required|exists:proveedor,id',
            'codigo_factura' => 'required|string|max:255|unique:nota_compra,codigo_factura',
            'fecha' => 'required|date|before_or_equal:today',
            'lugar' => 'nullable|string|max:255',
            'recibido' => 'nullable|string|max:255',
            'compra_credito' => 'required|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'user_id.required' => 'El usuario es obligatorio.',
            'user_id.exists' => 'El usuario seleccionado no es válido.',
            'gestion_id.required' => 'La gestión es obligatoria.',  
            'gestion_id.exists' => 'La gestión seleccionada no es válida.',
            'proveedor_id.required' => 'El proveedor es obligatorio.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
            'codigo_factura.required' => 'El código de factura es obligatorio.',
            'codigo_factura.string' => 'El código de factura debe ser una cadena de texto.',    
            'codigo_factura.max' => 'El código de factura no puede exceder los 255 caracteres.',
            'codigo_factura.unique' => 'El código de factura ya está en uso.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'fecha.before_or_equal' => 'La fecha no puede ser futura.',
            'lugar.string' => 'El lugar debe ser una cadena de texto.',
            'lugar.max' => 'El lugar no puede exceder los 255 caracteres.',
            'recibido.string' => 'El campo recibido debe ser una cadena de texto.', 
            'recibido.max' => 'El campo recibido no puede exceder los 255 caracteres.',
            'compra_credito.required' => 'El campo compra crédito es obligatorio.',
            'compra_credito.boolean' => 'El campo compra crédito debe ser verdadero o falso.',
        ];
    }
          
}
