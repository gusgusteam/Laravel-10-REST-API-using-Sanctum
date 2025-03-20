<?php

namespace App\Http\Requests\NotaVenta;

use Illuminate\Foundation\Http\FormRequest;

class AnularNotaVentaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'motivo' => 'required|string|max:255',
            'codigo_factura' => 'required|string|max:255|exists:nota_ventas,codigo_factura',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo_factura.exists' => 'El código de factura seleccionado no es válido.',
            'codigo_factura.required' => 'El código de factura es obligatorio.',
            'codigo_factura.string' => 'El código de factura debe ser una cadena de texto.',
            'codigo_factura.max' => 'El código de factura no debe ser mayor a 255 caracteres.',
            'motivo.required' => 'El motivo es obligatorio.',
            'motivo.string' => 'El motivo debe ser una cadena de texto.',
            'motivo.max' => 'El motivo no debe ser mayor a 255 caracteres.',
        ];
    }

}
