<?php

namespace App\Http\Requests\Producto;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'dosis' => 'nullable|string',
            'precio_estimado' => 'required|numeric',
            'margen_minimo' => 'required|numeric',
            'margen_standar' => 'required|numeric',
            'margen_maximo' => 'required|numeric',
            'estado' => 'nullable|boolean',
            'categoria_id' => 'required|exists:categorias,id',
            'tipo_producto_id' => 'required|exists:tipo_productos,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.string' => 'El nombre del producto debe ser una cadena de texto.',
            'nombre.max' => 'El nombre del producto no debe exceder los 255 caracteres.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'precio_estimado.required' => 'El precio estimado es obligatorio.',
            'precio_estimado.numeric' => 'El precio estimado debe ser un número.',
            'margen_minimo.required' => 'El margen mínimo es obligatorio.',
            'margen_minimo.numeric' => 'El margen mínimo debe ser un número.',
            'margen_standar.required' => 'El margen estándar es obligatorio.',
            'margen_standar.numeric' => 'El margen estándar debe ser un número.',
            'margen_maximo.required' => 'El margen máximo es obligatorio.',
            'margen_maximo.numeric' => 'El margen máximo debe ser un número.',
            'categoria_id.required' => 'La categoría es obligatoria.',
            'categoria_id.exists' => 'La categoría seleccionada no es válida.',
            'tipo_producto_id.required' => 'El tipo de producto es obligatorio.',
            'tipo_producto_id.exists' => 'El tipo de producto seleccionado no es válido.',
        ];
    }
}

