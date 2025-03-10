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
        return [
            'cantidad' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return (new StoreProductoEnvaseRequest())->messages();
    }

}
