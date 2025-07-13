<?php

namespace App\Http\Requests\ProductoEnvase;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoEnvaseRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'codigo' => 'nullable|string',
            'producto_id' => 'required|exists:productos,id',
            'unidad_id' => 'required|exists:unidads,id',
            'cantidad' => 'required|integer|min:1',
            'precio_estimado' => 'required|numeric',
            'margen_minimo' => 'required|numeric',
            'margen_standar' => 'required|numeric',
            'margen_maximo' => 'required|numeric',
            'image' => 'nullable|string',

            //'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'codigo.string' => 'El codigo debe ser texto',
            'producto_id.required' => 'El ID del producto es obligatorio.',
            'producto_id.exists' => 'El producto seleccionado no existe.',
            'unidad_id.required' => 'El ID de la unidad es obligatorio.',
            'unidad_id.exists' => 'La unidad seleccionado no existe.',
            'cantidad.required' => 'La cantidad es obligatoria.',
            'cantidad.integer' => 'La cantidad debe ser un número entero.',
            'cantidad.min' => 'La cantidad debe ser mayor o igual a 1.',
            'precio_estimado.required' => 'El precio estimado es obligatorio.',
            'precio_estimado.numeric' => 'El precio estimado debe ser un número.',
            'margen_minimo.required' => 'El margen mínimo es obligatorio.',
            'margen_minimo.numeric' => 'El margen mínimo debe ser un número.',
            'margen_standar.required' => 'El margen estándar es obligatorio.',
            'margen_standar.numeric' => 'El margen estándar debe ser un número.',
            'margen_maximo.required' => 'El margen máximo es obligatorio.',
            'margen_maximo.numeric' => 'El margen máximo debe ser un número.',
            'image.string' => 'El campo de la imagen debe ser una cadena de texto.',

            //'image.image' => 'El archivo debe ser una imagen.',
            //'image.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, svg.',
            //'image.max' => 'La imagen no debe exceder los 2MB.',

        ];
    }

}
