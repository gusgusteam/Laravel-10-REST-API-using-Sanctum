<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DetalleVentaResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nota_venta' => new NotaVentaResource($this->whenLoaded('notaVenta')),
            'producto_envase' => new ProductoEnvaseResource($this->whenLoaded('productoEnvase')),
            'precio_asignado' => $this->precio_asignado,
            'cantidad' => $this->cantidad,
            'subtotal' => $this->subtotal,
            'dosis_recomendada' => $this->dosis_recomendada,
            'dosis_comercial' => $this->dosis_comercial,
            'observacion' => $this->observacion,
            'estado' => $this->estado,
        ];
    }
}

