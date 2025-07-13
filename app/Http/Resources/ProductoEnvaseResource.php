<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductoEnvaseResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'producto_id' => $this->producto_id,
            'unidad_id' => $this->unidad_id,
            'cantidad' => $this->cantidad,
            'precio_estimado' => $this->precio_estimado,
            'margen_minimo' => $this->margen_minimo,
            'margen_standar' => $this->margen_standar,
            'margen_maximo' => $this->margen_maximo,
            'estado' => $this->estado,
            // Si tienes más atributos o relaciones, puedes agregarlos aquí
            'producto' => new ProductoResource($this->whenLoaded('producto')),
            'unidad' => new UnidadResource($this->whenLoaded('unidad')),
            //'producto' => new ProductoResource($this->producto),
            //'unidad' => new UnidadResource($this->unidad),
        ];
    }
}
