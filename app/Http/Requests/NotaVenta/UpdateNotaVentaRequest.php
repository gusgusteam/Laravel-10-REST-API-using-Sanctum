<?php

namespace App\Http\Requests\NotaVenta;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNotaVentaRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $notaventaeId = $this->route('id'); 
        $rules = (new StoreNotaVentaRequest())->rules(); 
        $rules['codigo_factura'] = [
            'required',
            'string',
            'max:255 ',
            Rule::unique('nota_ventas')->ignore($notaventaeId),
        ];
        return $rules;
    }

    public function messages(): array
    {
        return (new StoreNotaVentaRequest())->messages();
    }
}
