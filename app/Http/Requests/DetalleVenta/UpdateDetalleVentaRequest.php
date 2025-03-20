<?php

namespace App\Http\Requests\DetalleVenta;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDetalleVentaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //'nota_venta_id' => 'required|exists:nota_ventas,id',
            //'producto_envase_id' => 'required|exists:producto_envase,id',
            //'precio_asignado' => 'required|numeric|min:0',
            'cantidad' => 'required|integer',
            //'subtotal' => 'required|numeric|min:0',
            //'dosis_recomendada' => 'nullable|string',
            //'dosis_comercial' => 'nullable|string',
            //'observacion' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return (new StoreDetalleVentaRequest())->messages();
    }
}
