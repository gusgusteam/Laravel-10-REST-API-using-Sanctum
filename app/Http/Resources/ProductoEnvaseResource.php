<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoEnvaseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'producto_id' => $this->producto_id,
            'unidad_id' => $this->unidad_id,
            'cantidad' => $this->cantidad,
            'estado' => $this->estado,
            // Si tienes más atributos o relaciones, puedes agregarlos aquí
            'producto' => new ProductoResource($this->whenLoaded('producto')),
            'unidad' => new UnidadResource($this->whenLoaded('unidad')),
            //'producto' => new ProductoResource($this->producto),
            //'unidad' => new UnidadResource($this->unidad),
        ];
    }
}
