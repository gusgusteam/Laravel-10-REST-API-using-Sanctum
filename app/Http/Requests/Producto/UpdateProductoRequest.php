<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return (new StoreProductoRequest())->rules();
    }

    public function messages(): array
    {
        return (new StoreProductoRequest())->messages();
    }
}

