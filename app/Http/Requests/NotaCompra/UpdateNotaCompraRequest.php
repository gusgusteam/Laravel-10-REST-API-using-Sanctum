<?php

namespace App\Http\Requests\NotaCompra;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNotaCompraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $notacompraeId = $this->route('id'); 
        $rules = (new StoreNotaCompraRequest())->rules(); 
        $rules['codigo_factura'] = [
            'required',
            'string',
            'max:255 ',
            Rule::unique('nota_compra')->ignore($notacompraeId),
        ];
        return $rules;
    }

    public function messages(): array
    {
        return (new StoreNotaCompraRequest())->messages();
    }
}
