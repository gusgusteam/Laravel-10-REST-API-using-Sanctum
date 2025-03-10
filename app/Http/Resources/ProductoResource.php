<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'dosis' => $this->dosis,
            'precio_estimado' => $this->precio_estimado,
            'margen_minimo' => $this->margen_minimo,
            'margen_standar' => $this->margen_standar,
            'margen_maximo' => $this->margen_maximo,
            'estado' => $this->estado,
            'categoria' => new CategoriaResource($this->whenLoaded('categoria')),
            'tipo_producto' => new TipoProductoResource($this->whenLoaded('tipoProducto')),
        ];
    }
}
