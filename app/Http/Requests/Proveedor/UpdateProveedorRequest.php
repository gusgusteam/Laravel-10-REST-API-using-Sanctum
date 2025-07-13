<?php

namespace App\Http\Requests\Proveedor;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProveedorRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rules = (new StoreProveedorRequest())->rules(); 
        return $rules;
    }

    public function messages(): array
    {
        return (new StoreProveedorRequest())->messages();
    }
}
