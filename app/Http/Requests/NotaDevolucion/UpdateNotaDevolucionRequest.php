<?php

namespace App\Http\Requests\NotaDevolucion;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNotaDevolucionRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $notaventaeId = $this->route('id'); 
        $rules = (new StoreNotaDevolucionRequest())->rules(); 
        $rules['codigo_factura'] = [
            'required',
            'string',
            'max:255 ',
            Rule::unique('nota_devolucion')->ignore($notaventaeId),
        ];
        return $rules;
    }

    public function messages(): array
    {
        return (new StoreNotaDevolucionRequest())->messages();
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
