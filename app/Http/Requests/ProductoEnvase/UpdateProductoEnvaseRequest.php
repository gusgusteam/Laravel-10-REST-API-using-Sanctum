<?php

namespace App\Http\Requests\ProductoEnvase;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoEnvaseRequest extends FormRequest
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
        //return (new StoreProductoEnvaseRequest())->rules();
        return [
            'codigo' => 'nullable|string',
            'cantidad' => 'required|integer|min:1',
            'precio_estimado' => 'required|numeric',
            'margen_minimo' => 'required|numeric',
            'margen_standar' => 'required|numeric',
            'margen_maximo' => 'required|numeric',
            'image' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return (new StoreProductoEnvaseRequest())->messages();
    }

}
