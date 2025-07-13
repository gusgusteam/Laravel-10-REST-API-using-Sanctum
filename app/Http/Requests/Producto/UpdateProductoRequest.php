<?php

namespace App\Http\Requests\Producto;

use App\Models\Producto;
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

    public function withValidator($validator)
    {
        $ProductoId = $this->route('id');
        $producto = Producto::find($ProductoId);

        if ($producto && $producto->estado == 0) {
            $validator->after(function ($validator) {
                $validator->errors()->add('estado', 'No se puede actualizar un producto inactivo.');
            });
        }
    }
}

