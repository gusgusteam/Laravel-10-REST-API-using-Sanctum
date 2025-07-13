<?php

namespace App\Http\Requests\Cliente;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClienteRequest extends FormRequest
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
        $clienteId = $this->route('id'); 
        $rules = (new StoreClienteRequest())->rules(); 
        $rules['ci'] = [
            'required',
            'string',
            'max:20',
            Rule::unique('clientes')->ignore($clienteId),
        ];
        return $rules;
    }

    public function messages(): array
    {
        return (new StoreClienteRequest())->messages();
    }
}
