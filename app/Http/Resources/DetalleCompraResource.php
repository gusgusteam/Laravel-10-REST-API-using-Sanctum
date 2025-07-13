<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DetalleCompraResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nota_compra_id' => $this->nota_compra_id,
            'producto_envase_id' => $this->producto_envase_id,
            'precio_asignado' => $this->precio_asignado,
            'cantidad' => $this->cantidad,
            'subtotal' => $this->subtotal,
            'observacion' => $this->observacion,
            'estado' => $this->estado,
        ];
    }
}
