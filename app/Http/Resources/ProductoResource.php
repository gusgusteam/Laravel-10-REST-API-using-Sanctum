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
            'estado' => $this->estado,
            'categoria' => new CategoriaResource($this->whenLoaded('categoria')),
            'tipo_producto' => new TipoProductoResource($this->whenLoaded('tipoProducto')),
        ];
    }
}
